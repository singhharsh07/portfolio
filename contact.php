<?php
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name && $email && $message) {
        $messages_file = '../messages.json';
        $messages = file_exists($messages_file) ? json_decode(file_get_contents($messages_file), true) : [];
        $messages[] = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'date' => date('Y-m-d H:i:s')
        ];
        file_put_contents($messages_file, json_encode($messages, JSON_PRETTY_PRINT));
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Harsh Kumar</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #23233a 0%, #6366f1 100%); color: #f3f4f6; min-height: 100vh; }
        .navbar { position: fixed; top: 0; left: 0; width: 100%; background: rgba(24,24,27,0.7); box-shadow: 0 2px 24px #6366f144; z-index: 1000; backdrop-filter: blur(12px) saturate(180%); border-bottom: 1px solid rgba(99,102,241,0.15); transition: background 0.3s; height: 48px; }
        .navbar-container { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; padding: 0.2rem 1rem; height: 48px; }
        .logo { font-size: 1.1rem; color: #fbbf24; font-weight: bold; letter-spacing: 1px; text-shadow: 0 1px 4px #6366f1aa; margin-right: 1.2rem; white-space: nowrap; }
        .nav-links { list-style: none; display: flex; gap: 1.1rem; margin: 0; padding: 0; align-items: center; }
        .nav-links li a { color: #a5b4fc; text-decoration: none; font-size: 0.98rem; font-weight: 500; padding: 5px 10px; border-radius: 6px; transition: color 0.3s, background 0.3s, box-shadow 0.3s; position: relative; line-height: 1.2; }
        .nav-links li a:hover, .nav-links li a:focus { color: #fff; background: linear-gradient(90deg, #6366f1 60%, #fbbf24 100%); box-shadow: 0 2px 12px #6366f1aa; }
        .nav-links li a.active { color: #fbbf24; background: #23233a; box-shadow: 0 2px 8px #fbbf24aa; }
        .contact-section { max-width: 500px; margin: 100px auto 0 auto; background: #23233a; border-radius: 20px; box-shadow: 0 8px 48px #6366f1aa, 0 2px 16px #23233a88; padding: 36px 32px 28px 32px; display: flex; flex-direction: column; align-items: center; border: 1.5px solid rgba(99,102,241,0.18); }
        .contact-section h2 { color: #fbbf24; margin-bottom: 1.2rem; font-size: 1.5rem; }
        form { width: 100%; display: flex; flex-direction: column; gap: 1.1rem; }
        label { color: #a5b4fc; font-weight: 600; margin-bottom: 0.2rem; }
        input, textarea { padding: 10px; border-radius: 8px; border: none; background: #18181b; color: #f3f4f6; font-size: 1rem; box-shadow: 0 1px 4px #6366f122; }
        textarea { min-height: 60px; max-height: 120px; }
        button { background: linear-gradient(90deg, #6366f1 60%, #fbbf24 100%); color: #fff; border: none; border-radius: 8px; padding: 10px 22px; font-size: 1.05rem; cursor: pointer; font-weight: 600; box-shadow: 0 2px 8px #6366f1aa; transition: background 0.3s, color 0.3s; text-decoration: none; display: inline-block; }
        button:hover { background: #fbbf24; color: #23233a; }
        .success-msg { color: #22c55e; background: #23233a; border: 1.5px solid #22c55e; border-radius: 8px; padding: 12px 18px; margin-bottom: 1rem; text-align: center; font-weight: 600; }
        @media (max-width: 600px) { .contact-section { padding: 18px 4vw 12px 4vw; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <span class="logo">Harsh Kumar</span>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="project.php">Projects</a></li>
                <li><a href="certifications.php">Certifications</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
        </div>
    </nav>
    <div class="contact-section">
        <h2>Contact Me</h2>
        <?php if ($success): ?>
            <div class="success-msg">Thank you! Your message has been sent.</div>
        <?php endif; ?>
        <form method="POST" action="contact.php">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>
