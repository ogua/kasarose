<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/mail-config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(403);
    echo "Access Denied.";
    exit;
}

/**
 * Every field any form on this site may post, in the order it should appear in the
 * email, mapped to the label the team reads in their inbox. Adding a field to a form
 * means adding it here — anything not listed is ignored rather than forwarded.
 *
 * `message` is handled separately at the end so it reads as a block, not a line.
 */
$fields = [
    'phone'             => 'Phone',
    'city'              => 'City',
    'ftype'             => 'Service Type',
    'wight'             => 'Weight',
    'dymention'         => 'Dimensions',
    'departure'         => 'Departure',
    'city_deliver'      => 'Delivery',
    'incoterms'         => 'Incoterms',
    'ship_date'         => 'Ship Date',
    'ship_time'         => 'Ship Time',
    // feedback.php
    'tracking_ref'      => 'Tracking Number / Reference',
    'feedback_about'    => 'Feedback About',
    'feedback_category' => 'Category',
    'rating'            => 'Rating (1-5)',
];

/** Strip tags and collapse newlines — header-injection safe for single-line values. */
$clean = static function (string $key): string {
    $value = strip_tags(trim($_POST[$key] ?? ''));
    return str_replace(["\r", "\n"], [' ', ' '], $value);
};

$name    = $clean('name');
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone   = $clean('phone');
$message = strip_tags(trim($_POST['message'] ?? ''));   // newlines preserved on purpose

if (empty($name) || empty($phone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please fill all required fields correctly.";
    exit;
}

// Which form this came from, so the team can triage from the subject line alone.
// Constrained to a known list — never echo an arbitrary POST value into a header.
$form_types = [
    'quote'    => 'Quote Request',
    'contact'  => 'Contact Message',
    'feedback' => 'Customer Feedback',
];
$form_type = $form_types[$_POST['form_type'] ?? ''] ?? 'Website Submission';

// Every inbox in $form_recipients (includes/config.php) gets a copy. Filtering here
// rather than letting addAddress() throw means one bad entry in the roster costs that
// recipient alone instead of the entire submission. Keyed by lowercased address so a
// duplicate cannot send the same person two copies; first spelling in the roster wins.
$recipients = [];
foreach ($form_recipients as $address) {
    $address = trim($address);
    $key     = strtolower($address);
    if ($address !== '' && !isset($recipients[$key]) && filter_var($address, FILTER_VALIDATE_EMAIL)) {
        $recipients[$key] = $address;
    }
}

if (!$recipients) {
    http_response_code(500);
    error_log('Mailer error: $form_recipients holds no valid address — nothing was sent.');
    echo "Server failed to send mail. Please try again later or contact us directly.";
    exit;
}

$subject = "$form_type from $name";

$email_content = "Form: $form_type\nName: $name\nEmail: $email\n";
foreach ($fields as $key => $label) {
    $value = $clean($key);
    if ($value !== '') {
        $email_content .= "$label: $value\n";
    }
}
if ($message !== '') {
    $email_content .= "\nMessage:\n$message\n";
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_SECURE;
    $mail->Port       = SMTP_PORT;

    $mail->setFrom(SMTP_USERNAME, 'KASAROSE LOGISTICS Website');
    foreach ($recipients as $address) {
        $mail->addAddress($address);
    }
    $mail->addReplyTo($email, $name);

    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $email_content;

    $mail->send();
    http_response_code(200);
    echo "Thank you! Your message has been sent successfully.";
} catch (Exception $e) {
    http_response_code(500);
    error_log("Mailer error: " . $mail->ErrorInfo);
    echo "Server failed to send mail. Please try again later or contact us directly.";
}
