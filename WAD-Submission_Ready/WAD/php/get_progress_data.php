<?php
/**
 * MyClass Class Doc Comment
 * php version 8.3.15
 *
 * @category Class
 * @package  PHP
 * @author   Maciej Makar <maciej.makar@mail.bcu.ac.uk>
 * @author   Noraiz Ahmed <noraiz.ahmed@mail.bcu.ac.uk>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/WAD/Mealplanusehome.php
 */
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

require_once __DIR__ . '/db_config.php';

$user_id = $_SESSION['user_id'];

// Query progress_report
$sql = "SELECT report_month, final_weight
        FROM progressreports
        WHERE user_id = ?
        ORDER BY report_month ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "date" => $row["report_month"],      // or rename if your column is different
        "weight" => (float)$row["final_weight"]
    ];
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
