<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate and Download Image</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .form-group button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .image-container {
            text-align: center;
            margin-top: 20px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .download-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Generate and Download Image</h2>
        <form action="{{ url('/generate-image') }}" method="GET">
            <div class="form-group">
                <label for="question">Enter your question:</label>
                <input type="text" id="question" name="question" placeholder="Enter a question..." required value="{{ $question ?? '' }}">
            </div>
            <div class="form-group">
                <button type="submit">Generate Image</button>
            </div>
        </form>

        @if (!empty($imageUrl))
            <div class="image-container">
                <h3>Generated Image:</h3>
                <img src="{{ $imageUrl }}" alt="Generated Image">
                <a href="{{ $imageUrl }}" class="download-btn" download="generated_image.png">Download Image</a>
            </div>
        @endif
    </div>
</body>
</html>
