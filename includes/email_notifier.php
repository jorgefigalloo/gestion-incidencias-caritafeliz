<?php
// includes/email_notifier.php
require_once __DIR__ . '/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailNotifier {
    private $mail;
    
    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }
    
    private function configureSMTP() {
        try {
            // Configuración del servidor SMTP
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com'; // Cambiar según tu proveedor
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'caritafelizapp@gmail.com'; // CAMBIAR POR TU EMAIL
            $this->mail->Password = 'sazh jtug iuka mpyf'; // CAMBIAR POR TU CONTRASEÑA DE APLICACIÓN
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;
            
            // Configuración general
            $this->mail->setFrom('noreply@clinicacaritafeliz.com', 'Sistema de Gestión TI - Clínica Carita Feliz');
            $this->mail->CharSet = 'UTF-8';
            $this->mail->isHTML(true);
            
        } catch (Exception $e) {
            error_log("Error configurando SMTP: " . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Envía notificación de nueva incidencia
     * @param array $incidenciaData Datos de la incidencia
     * @return bool True si se envió correctamente
     */
    public function enviarNotificacionNuevaIncidencia($incidenciaData) {
        try {
            // Limpiar destinatarios previos
            $this->mail->clearAddresses();
            $this->mail->clearCCs();
            
            // Destinatarios principales
            $this->mail->addAddress('sistemas@clinicacaritafeliz.com', 'Área de Sistemas');
            $this->mail->addAddress('helpdesk@clinicacaritafeliz.com', 'Help Desk');
            $this->mail->addAddress('caritafelizapp@gmail.com', 'Gmail de pruebas');
            
            // Copia al reportante si tiene email
            if (!empty($incidenciaData['email_reporta'])) {
                $this->mail->addCC($incidenciaData['email_reporta'], $incidenciaData['nombre_reporta']);
            }
            
            // Asunto
            $prioridad = strtoupper($incidenciaData['prioridad']);
            $this->mail->Subject = "[NUEVA INCIDENCIA - {$prioridad}] {$incidenciaData['titulo']}";
            
            // Cuerpo del mensaje
            $this->mail->Body = $this->generarHTMLEmail($incidenciaData);
            $this->mail->AltBody = $this->generarTextoPlano($incidenciaData);
            
            // Enviar
            $resultado = $this->mail->send();
            
            if ($resultado) {
                error_log("Email de incidencia enviado exitosamente");
            }
            
            return $resultado;
            
        } catch (Exception $e) {
            error_log("Error al enviar email de incidencia: " . $this->mail->ErrorInfo);
            return false;
        }
    }
    
    /**
     * Genera el cuerpo HTML del email
     */
    private function generarHTMLEmail($data) {
        $prioridadColor = $this->obtenerColorPrioridad($data['prioridad']);
        $prioridadTexto = $this->obtenerTextoPrioridad($data['prioridad']);
        
        $html = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
                .info-box { background: white; padding: 20px; margin: 15px 0; border-left: 4px solid #667eea; border-radius: 5px; }
                .label { font-weight: bold; color: #555; display: inline-block; min-width: 150px; }
                .value { color: #333; }
                .priority-badge { display: inline-block; padding: 5px 15px; border-radius: 20px; color: white; font-weight: bold; background: ' . $prioridadColor . '; }
                .footer { text-align: center; color: #777; font-size: 12px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; }
                .btn { display: inline-block; padding: 12px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>🚨 Nueva Incidencia Reportada</h1>
                    <p>Sistema de Gestión de TI - Clínica Carita Feliz</p>
                </div>
                
                <div class="content">
                    <div class="info-box">
                        <p><span class="label">Título:</span><br>
                        <strong>' . htmlspecialchars($data['titulo']) . '</strong></p>
                    </div>
                    
                    <div class="info-box">
                        <p><span class="label">Descripción:</span><br>
                        ' . nl2br(htmlspecialchars($data['descripcion'])) . '</p>
                    </div>
                    
                    <div class="info-box">
                        <p><span class="label">Reportado por:</span> <span class="value">' . htmlspecialchars($data['nombre_reporta']) . '</span></p>
                        <p><span class="label">Email:</span> <span class="value">' . htmlspecialchars($data['email_reporta']) . '</span></p>
                        <p><span class="label">Fecha:</span> <span class="value">' . date('d/m/Y H:i:s') . '</span></p>
                    </div>
                    
                    <div class="info-box">
                        <p><span class="label">Prioridad:</span> <span class="priority-badge">' . $prioridadTexto . '</span></p>
                        <p><span class="label">Estado:</span> <span class="value">Abierta</span></p>
                        ' . (!empty($data['tipo_nombre']) ? '<p><span class="label">Tipo:</span> <span class="value">' . htmlspecialchars($data['tipo_nombre']) . '</span></p>' : '') . '
                    </div>
                    
                    <div style="text-align: center;">
                        <a href="http://localhost/clinicacaritafeliz-gestion/views/dashboard.php" class="btn">Ver en el Dashboard</a>
                    </div>
                </div>
                
                <div class="footer">
                    <p>Este es un mensaje automático del Sistema de Gestión de TI</p>
                    <p>Clínica Carita Feliz - Departamento de Tecnología</p>
                    <p>Por favor, no responda a este correo</p>
                </div>
            </div>
        </body>
        </html>';
        
        return $html;
    }
    
    /**
     * Genera el cuerpo de texto plano del email
     */
    private function generarTextoPlano($data) {
        $prioridadTexto = $this->obtenerTextoPrioridad($data['prioridad']);
        
        $texto = "NUEVA INCIDENCIA REPORTADA\n";
        $texto .= "Sistema de Gestión de TI - Clínica Carita Feliz\n";
        $texto .= "==========================================\n\n";
        $texto .= "TÍTULO: " . $data['titulo'] . "\n\n";
        $texto .= "DESCRIPCIÓN:\n" . $data['descripcion'] . "\n\n";
        $texto .= "REPORTADO POR: " . $data['nombre_reporta'] . "\n";
        $texto .= "EMAIL: " . $data['email_reporta'] . "\n";
        $texto .= "FECHA: " . date('d/m/Y H:i:s') . "\n\n";
        $texto .= "PRIORIDAD: " . $prioridadTexto . "\n";
        $texto .= "ESTADO: Abierta\n";
        
        if (!empty($data['tipo_nombre'])) {
            $texto .= "TIPO: " . $data['tipo_nombre'] . "\n";
        }
        
        $texto .= "\n==========================================\n";
        $texto .= "Este es un mensaje automático.\n";
        $texto .= "Por favor, no responda a este correo.\n";
        
        return $texto;
    }
    
    /**
     * Obtiene el color según la prioridad
     */
    private function obtenerColorPrioridad($prioridad) {
        $colores = [
            'baja' => '#10b981',
            'media' => '#f59e0b',
            'alta' => '#f97316',
            'critica' => '#ef4444'
        ];
        return $colores[$prioridad] ?? '#6b7280';
    }
    
    /**
     * Obtiene el texto según la prioridad
     */
    private function obtenerTextoPrioridad($prioridad) {
        $textos = [
            'baja' => '🟢 BAJA',
            'media' => '🟡 MEDIA',
            'alta' => '🟠 ALTA',
            'critica' => '🔴 CRÍTICA'
        ];
        return $textos[$prioridad] ?? 'MEDIA';
    }
}
?>