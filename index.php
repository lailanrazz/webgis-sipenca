<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Cagar Budaya Kabupaten Sleman</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/font-icon.css">
<link rel="stylesheet" href="css/animate.min.css">
<link rel="stylesheet" type="text/css" href="css/style4.css" />
<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">
<link rel="icon" href="http://luk.staff.ugm.ac.id/logo/UGM/Resmi/Warna.gif" type="image/x-icon">
    <style>
        body {
            background-color: #f5deb3; 
            color: #8b4513; 
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px 0; 
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column; 
        }

        #title-container {
            margin-bottom: 20px; 
        }

        #content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #8b4513; 
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #8b4513; 
            color: #fff; 
        }

        tr:nth-child(even) {
            background-color: #f5deb3; 
        }

        tr:nth-child(odd) {
            background-color: #f5deb3; 
        }

        tr:hover {
            background-color: #fff;
        }
        
    </style>
</head>

<body>
<section class="banner" role="banner">
  <header id="header">
    <div class="header-content clearfix"> 
      <nav class="navigation" role="navigation">
        <ul class="primary-nav">
		 <li><a href="index.html">Kembali Ke Beranda</a></li>
		  <li><a href="#intro"></a></li>
      <li><a href=web2.php></a></li> 
      <li><a href=index.php></a></li>  
      <li><a href=input.php></a></li>  
          <li><a href="login.php"></a></li>
        </ul>
      </nav>
      <a href="#" class="nav-toggle">Menu<span></span></a> </div>
  </header>
    <div id="content-container">
        <div id="title-container">
            <h4 style="color: #8b4513;">Data Cagar Budaya Kabupaten Sleman</h4>
        </div>
        
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "diy";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkColumnsQuery = "SHOW COLUMNS FROM cagar_budaya LIKE 'longitude'";
    $checkColumnsResult = $conn->query($checkColumnsQuery);

    if ($checkColumnsResult->num_rows == 0) {
        $alterTableQuery = "ALTER TABLE cagar_budaya
            ADD COLUMN longitude DECIMAL(8,4) AFTER kecamatan,
            ADD COLUMN latitude DECIMAL(8,4) AFTER longitude";
        $conn->query($alterTableQuery);
    }

    $sql = "SELECT * FROM cagar_budaya";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Nama</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Kategori</th>
                </tr>";

        $row_number = 0;
        while ($row = $result->fetch_assoc()) {
            $row_number++;
            $row_class = $row_number % 2 == 0 ? "even-row" : "odd-row";
            echo "<tr class='$row_class'>
                    <td>" . $row["nama"] . "</td>
                    <td>" . $row["longitude"] . "</td>
                    <td>" . $row["latitude"] . "</td>
                    <td>" . $row["kategori"] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</body>

</html>




