<?php

require_once __DIR__ . '/../lib/stripe/init.php';
require_once __DIR__ . '/../Model/Classes/User.php';

if (!isset($_GET['session_id'])) {
    header('Location: /premium');
    exit;
}

\Stripe\Stripe::setApiKey('sk_test_51RVrxgQ46PVjWGdXHNKc9goQkExIJozD1NAUJiIKYNdlZ6I6VvCB0Myyvnl07UQoxhfOSXL2IbbY6lNwFEx9G8Zk00yWgE7KEk');

try {
    $session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);
    
    if ($session->payment_status === 'paid') {
        $userId = $session->metadata->user_id;
        
        // Update user to premium
        if (User::upgradeToPremium($userId)) {
            // Update session
            $_SESSION['userType'] = 'Premium';
            
            // Redirect to success page
            header('Location: /');
            exit;
        }
    }
    
    // If something went wrong, redirect back to premium page
    header('Location: /premium');
    exit;
} catch (Error $e) {
    // Log error and redirect
    error_log($e->getMessage());
    header('Location: /premium');
    exit;
} 