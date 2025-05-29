<?php
session_start();
include_once('connection.php');
$con = connection();

// Query to get all post content
$sql = "SELECT content FROM posts";
$result = $con->query($sql);

// Array to store hashtag counts
$hashtags = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        preg_match_all('/#\w+/', $row['content'], $matches);
        foreach ($matches[0] as $tag) {
            $tag = strtolower($tag);
            if (isset($hashtags[$tag])) {
                $hashtags[$tag]++;
            } else {
                $hashtags[$tag] = 1;
            }
        }
    }
} else {
    echo "<p>No posts found.</p>";
    exit();
}

// Sort hashtags by count descending
arsort($hashtags);

// Prepare data for JavaScript
$hashtagLabels = json_encode(array_keys($hashtags));
$hashtagCounts = json_encode(array_values($hashtags));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hashtag Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
body {
  margin: 0;
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(to right, rgb(15, 63, 12), rgb(105, 146, 121));
  color: white;
  padding: 40px;
  box-sizing: border-box;
}

h2 {
  text-align: center;
  font-size: 36px;
  margin-bottom: 10px;
  font-weight: 600;
}

a {
  display: block;
  text-align: center;
  margin-bottom: 40px;
  color: white;
  font-weight: bold;
  text-decoration: none;
  background-color: rgb(17, 99, 28);
  width: 200px;
  padding: 9px;
  margin-inline: auto;
  margin-top: 20px;
  border-radius: 5px;
}
a:hover {
    background-color: rgb(29, 116, 40);
}

table {
  width: 100%;
  max-width: 800px;
  margin: 0 auto 40px auto;
  border-collapse: collapse;
  background-color: rgba(255, 255, 255, 0.07);
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

thead {
  background-color: rgba(255, 255, 255, 0.12);
}

th, td {
  padding: 16px;
  text-align: left;
}

th {
  font-size: 18px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

tr:nth-child(even) {
  background-color: rgba(255, 255, 255, 0.05);
}

canvas {
  display: block;
  max-width: 800px;
  margin: 40px auto;
  background-color: white;
  padding: 20px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}
</style>

</head>
<body>

<h2>Hashtag Usage Dashboard </h2>
<a href="newsfeed.php">Home</a>

<!-- Table -->
<table>
    <thead>
        <tr>
            <th>Hashtag</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($hashtags as $tag => $count): ?>
        <tr>
            <td><?php echo htmlspecialchars($tag); ?></td>
            <td><?php echo $count; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Bar Chart -->
<canvas id="barChart"></canvas>

<!-- Pie Chart -->
<canvas id="pieChart"></canvas>

<script>
  const labels = <?php echo $hashtagLabels; ?>;
  const data = <?php echo $hashtagCounts; ?>;

  const greenShades = [
    'rgb(17, 99, 28)',
    'rgb(29, 116, 40)',
    'rgb(46, 134, 54)',
    'rgb(66, 153, 64)',
    'rgb(87, 170, 77)',
    'rgb(110, 190, 92)',
    'rgb(135, 210, 105)',
    'rgb(161, 230, 120)'
  ];

  const barConfig = {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Hashtag Count',
        data: data,
        backgroundColor: greenShades
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Most Used Hashtags (Bar Chart)',
          color: 'black'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { stepSize: 1, color: 'black' },
          grid: { color: 'rgba(0,0,0,0.1)' }
        },
        x: {
          ticks: { color: 'black' },
          grid: { color: 'rgba(0,0,0,0.05)' }
        }
      }
    }
  };

  const pieConfig = {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: greenShades
      }]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'Hashtag Distribution (Pie Chart)',
          color: 'black'
        },
        legend: {
          labels: { color: 'black' }
        }
      }
    }
  };

  new Chart(document.getElementById('barChart'), barConfig);
  new Chart(document.getElementById('pieChart'), pieConfig);
</script>



</body>
</html>
