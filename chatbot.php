<?php
// chatbot.php — simple PHP proxy to free AI API (no key required)

// Allow CORS for local testing
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Get user message
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = $data["message"] ?? "";

// Basic tourism-style reply (mock AI using simple rules)
$lower = strtolower($userMessage);
$response = "I'm your tourism assistant! Ask me about famous places, hotels, or travel info.";

if (strpos($lower, "delhi") !== false) {
    $response = "Delhi is known for India Gate, Qutub Minar, Red Fort, and Chandni Chowk! Would you like travel tips?";
} elseif (strpos($lower, "agra") !== false) {
    $response = "Agra is home to the iconic Taj Mahal — best visited early morning or evening!";
} elseif (strpos($lower, "hotel") !== false) {
    $response = "You can find great budget and luxury hotels via MakeMyTrip or Booking.com!";
} elseif (strpos($lower, "hello") !== false || strpos($lower, "hi") !== false) {
    $response = "Hello! How can I help plan your next trip?";
} elseif (strpos($lower, "help") !== false) {
    $response = "Sure! I can tell you about tourist spots, weather, or transport info. Try asking: 'What to see in Delhi?'";
}

// Return response
echo json_encode(["reply" => $response]);
?>
