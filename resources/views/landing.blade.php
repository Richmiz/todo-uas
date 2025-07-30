<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo.rich - Manage Your Task</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #F8F9FA; min-height: 100vh; display: flex; justify-content: center;">
    <div style="background: #F8F9FA; border-radius: 24px; padding: 40px; width: 100%;">
        <!-- Header -->
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; flex-wrap: wrap; gap: 20px;">
            <div style="display: flex; align-items: center; gap: 8px; font-size: 18px; font-weight: 600; color: #333;">
                <div style="width: 32px; height: 32px; background: #FF6B35; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">TR</div>
                <span>Todo.rich</span>
            </div>
            
            <div style="display: flex; gap: 16px;">
                <a href="{{ route('login') }}" style="padding: 10px 24px; color: #333; font-size: 14px; font-weight: 500; background: transparent; border: none; cursor: pointer; text-decoration: none;">Sign In</a>
                <a href="{{ route('register') }}" style="padding: 10px 24px; color: #4CAF50; font-size: 14px; font-weight: 500; background: transparent; border: none; cursor: pointer; text-decoration: none;">Register</a>
            </div>
        </header>
        
        <!-- Hero Section -->
        <div style="text-align: center; margin-bottom: 60px;">
            <h1 style="font-size: 48px; font-weight: 700; color: #333; margin-bottom: 16px;">Manage Your Task.</h1>
            <p style="font-size: 16px; color: #666; margin-bottom: 32px; line-height: 1.6;">
                Encan boards, lists, and cards enable you to organize and prioritize your projects in a fun,<br>
                flexible, and rewarding way. Let's started 😊
            </p>
        </div>
         <!-- Dashboard Preview -->
        <div style="background: white; border-radius: 20px; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-top: 40px; display: flex; align-items: center; justify-content: center; gap: 40px;">
            <img src="/images/welcome-left.png" alt="Welcome Left" style="max-width: 220px; width: 100%; height: auto;">
            <div style="text-align: center; max-width: 400px;">
                <h2 style="font-size: 28px; font-weight: 700; color: #333; margin-bottom: 20px;">We will give you a focus, from work to play</h2>
                <a href="{{ route('register') }}" style="display: inline-block; background: #FF6B35; color: white; padding: 14px 32px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-decoration: none;">Get Started</a>
            </div>
            <img src="/images/welcome-right.png" alt="Welcome Right" style="max-width: 220px; width: 100%; height: auto;">
        </div>
        
    </div>
</body>
</html>