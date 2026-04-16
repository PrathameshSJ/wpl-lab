<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result (REQUEST)</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>

<div class="result-container">
    <h2>Submission Successful (REQUEST Method)</h2>
    <?php
    if (!empty($_REQUEST['pname'])) {
        // Sanitize and Validate Inputs using $_REQUEST
        $name = htmlspecialchars(trim($_REQUEST['pname'] ?? ''));
        $email = filter_var(trim($_REQUEST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_REQUEST['phone'] ?? ''));
        $dept = htmlspecialchars($_REQUEST['dept'] ?? '');
        $gender = htmlspecialchars($_REQUEST['gender'] ?? 'Not Specified');
        $stack = isset($_REQUEST['stack']) ? $_REQUEST['stack'] : [];

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
            // Display structured data cleanly
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
        }
    } else {
        echo "<p>No data received via REQUEST method.</p>";
    }
    ?>
    <br>
    <a href="register.html" class="back-link">Go Back</a>
</div>

</body>
</html>
