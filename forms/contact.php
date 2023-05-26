<?php
// Function to make API call to ChatGPT API
function callChatGPTAPI($message) {
    $api_key = 'YOUR_API_KEY'; // Replace with your actual API key
    $endpoint = 'https://api.openai.com/v1/chat/completions';

    $data = array(
        'prompt' => $message,
        'max_tokens' => 50,
        'temperature' => 0.7,
        'n' => 1
    );

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    );

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true)['choices'][0]['text'];
}

// Process the contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Generate response using ChatGPT API
    $response = callChatGPTAPI($message);

    // Predefined details to include in the response
    $predefinedDetails = "My Contact Details:\n";
    $predefinedDetails .= "Name: Your Name\n";
    $predefinedDetails .= "Email: yourname@example.com\n";
    $predefinedDetails .= "Phone: +1-123-456-7890\n";

    // Combine the response and predefined details
    $combinedResponse = $response . "\n\n" . $predefinedDetails;

    // Send the response to the user (e.g., via email or displaying on the webpage)
    echo $combinedResponse;
}
?>
