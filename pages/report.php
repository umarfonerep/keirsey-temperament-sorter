<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keirsey Temperament Test Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: black;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container-content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 60%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .heading {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #1E7AC2;
            margin-bottom: 20px;
        }
        .report-table {
            margin-top: 10px;
        }
        /* Results Table */
        .table thead {
            background-color: #1E7AC2;
            color: white;
        }
        .footer {
            background-color: #1E7AC2;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
            width: 100%;
        }
        .cta-text {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .signup-link {
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
        }
        .signup-link a {
            color: #1E7AC2;
            font-weight: bold;
            text-decoration: none;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container-content">
        <div class="card">
            <!-- Page Heading -->
            <h1 class="heading">Keirsey Temperament Test Report</h1>

            <!-- Results Table (Same as `admin_results.php`) -->
            <table class="table table-bordered report-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Group</th>
                        <th>Aspect</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Extrovert</td>
                        <td>Social</td>
                        <td>Leadership</td>
                        <td>Great at handling social situations.</td>
                    </tr>
                </tbody>
            </table>

            <!-- Call to Action -->
            <p class="cta-text">Wanna give Keirsey Temperament Test?</p>
            <p class="signup-link">
                <a href="signup.php">Sign up here</a>
            </p>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
