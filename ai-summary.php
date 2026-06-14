<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$apiKey = $_ENV['GEMINI_API_KEY'];

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

$prompt = "
You are an HR assistant.

Generate a short professional summary based on the following user data.

Name: {$user['name']}
Email: {$user['email']}
Phone: {$user['phone']}

Assume the user is a PHP Full Stack Developer working with Docker, GitHub Actions, CI/CD, MySQL and AI integration.

Return only 2-3 professional lines.
";

$data = [
    "contents" => [
        [
            "parts" => [
                [
                    "text" => $prompt
                ]
            ]
        ]
    ]
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

curl_close($ch);

$result = json_decode($response, true);

$summary = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'No summary generated';

echo "<h2>AI Summary</h2>";
echo "<p>$summary</p>";
echo "<br><a href='index.php'>Back</a>";