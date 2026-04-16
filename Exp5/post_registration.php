<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result (POST)</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>

<div class="result-container">
    <h2>Submission Successful (POST Method)</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and Validate Inputs
        $name = htmlspecialchars(trim($_POST['pname'] ?? ''));
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
        $dept = htmlspecialchars($_POST['dept'] ?? '');
        $gender = htmlspecialchars($_POST['gender'] ?? 'Not Specified');
        $stack = isset($_POST['stack']) ? $_POST['stack'] : [];

        $errors = [];

        // Server-side validation
        if (empty($name)) {
            $errors[] = "Name is a mandatory field.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (count($errors) > 0) {
            echo "<div style='color: red;'><h3>Validation Errors:</h3><ul>";
            foreach ($errors as $err) {
                echo "<li>" . htmlspecialchars($err) . "</li>";
            }
            echo "</ul></div>";
        } else {
            // Display structured data
            echo "<div class='result-item'><strong>Name:</strong> " . $name . "</div>";
            echo "<div class='result-item'><strong>Email:</strong> " . $email . "</div>";
            echo "<div class='result-item'><strong>Phone:</strong> " . (!empty($phone) ? $phone : 'N/A') . "</div>";
            echo "<div class='result-item'><strong>Branch:</strong> " . strtoupper($dept) . "</div>";
            echo "<div class='result-item'><strong>Gender:</strong> " . ucfirst($gender) . "</div>";
            
            echo "<div class='result-item'><strong>Tech Stack:</strong> ";
            if (!empty($stack)) {
                echo implode(", ", array_map('htmlspecialchars', $stack));
            } else {
                echo "None Selected";
            }
            echo "</div>";

            // Personalized greeting based on input
            echo "<div class='result-item' style='margin-top: 20px; padding: 15px; background: #e3f2fd; border-radius: 4px;'>";
            echo "<strong>Welcome Message:</strong> Hello, " . $name . "! We are thrilled to have a student from the " . strtoupper($dept) . " department joining our hackathon.";
            if (in_array("AI / ML", $stack)) {
                echo " We see you are interested in AI/ML – make sure to check out the neural network workshops!";
            }
            echo "</div>";
        }
    } else {
        echo "<p>No data received via POST method.</p>";
    }
    ?>
    <br>
    <a href="register.html" class="back-link">Go Back</a>
</div>

</body>
</html>
