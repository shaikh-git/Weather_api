<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            background-image: url(assests/ba.jpg); /* Replace with correct path to your background image */
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
        }

        /* Center the content */
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        /* Styling the card */
        .card {
            background-color: rgba(255, 255, 255, 0.85);  
            border-radius: 20px;
            
            padding: 40px;
            box-shadow: 10px 20px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(50px);
            width: 100%;
            max-width: 400px;
        }

        /* Card title styling */
        .card h3 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        /* Input and button styling */
        .form-control {
            border-radius: 25px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1.1rem;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Weather results and error message */
        #weatherResult {
            margin-top: 20px;
        }

        #weatherResult h4 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        #weatherResult p {
            font-size: 1.2rem;
        }

        /* Error message styling */
        .alert {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h3>Weather App</h3>
            <!-- Input for city name -->
            <input type="text" id="city" class="form-control" placeholder="Enter city">
            <button id="getWeather" class="btn btn-primary">Get Weather</button>

            <!-- Weather result section -->
            <div id="weatherResult" style="display: none;">
                <h4 id="cityName"></h4>
                <p id="temperature"></p>
                <p id="description"></p>
                <p id="humidity"></p>
                <p id="wind"></p>
            </div>

            <!-- Error message -->
            <div id="errorMsg" class="alert alert-danger"></div>
        </div>
    </div>

    <script>
        // Replace with your OpenWeatherMap API key
        const apiKey = '3488ea5e25620c069a8632878761d675';

        // When "Get Weather" button is clicked
        $('#getWeather').click(function() {
            const city = $('#city').val();  // Get the city name from the input

            // Check if the city field is empty
            if (city === '') {
                alert('Please enter a city name.');
                return;
            }

            // Make AJAX request to OpenWeatherMap API
            $.ajax({
                url: `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`,
                method: 'GET',
                success: function(response) {
                    // On successful response, show the weather data
                    $('#cityName').text(response.name + ', ' + response.sys.country);
                    $('#temperature').text('Temperature: ' + response.main.temp + '°C');
                    $('#description').text('Description: ' + response.weather[0].description);
                    $('#humidity').text('Humidity: ' + response.main.humidity + '%');
                    $('#wind').text('Wind Speed: ' + response.wind.speed + ' m/s');
                    
                    // Show weather result and hide error message
                    $('#weatherResult').show();
                    $('#errorMsg').hide();
                },
                error: function() {
                    // If there is an error, show the error message
                    $('#errorMsg').text('City not found. Please try again.');
                    $('#errorMsg').show();
                    $('#weatherResult').hide();
                }
            });
        });
    </script>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
