
<?php
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../koneksi.php";

function response($status, $message, $data = null) {
    http_response_code($status);

    $result = [
        "success" => $status >= 200 && $status < 300,
        "message" => $message
    ];

    if ($data !== null) {
        $result["data"] = $data;
    }

    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
}

function getInput() {
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!is_array($data) || json_last_error() !== JSON_ERROR_NONE) {
        response(400, "Data JSON tidak valid atau tidak lengkap");
    }

    return $data;
}

function validateInput($data) {
    foreach (["nim", "nama", "email"] as $field) {
        if (!isset($data[$field]) ||
            !is_string($data[$field]) ||
            trim($data[$field]) === "") {
            response(400, "Field $field wajib diisi");
        }
    }

    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        response(400, "Format email tidak valid");
    }

    return [
        trim($data["nim"]),
        trim($data["nama"]),
        trim($data["email"])
    ];
}

$method = $_SERVER["REQUEST_METHOD"];
$id = isset($_GET["id"]) ? $_GET["id"] : null;

// Validasi ID
if ($id !== null &&
    (!ctype_digit((string)$id) || (int)$id < 1)) {
    response(400, "ID harus berupa bilangan bulat positif");
}

try {
    switch ($method) {

        // GET: Menampilkan seluruh mahasiswa
        case "GET":
            if ($id !== null) {
                $stmt = $conn->prepare(
                    "SELECT id, nim, nama, email
                     FROM mahasiswa WHERE id = ?"
                );
                $stmt->bind_param("i", $id);
                $stmt->execute();

                $result = $stmt->get_result();
                $mahasiswa = $result->fetch_assoc();

                if (!$mahasiswa) {
                    response(404, "Mahasiswa tidak ditemukan");
                }

                response(200, "Data mahasiswa ditemukan", $mahasiswa);
            }

            $result = $conn->query(
                "SELECT id, nim, nama, email FROM mahasiswa ORDER BY id"
            );

            response(200, "Data seluruh mahasiswa ditemukan",
                $result->fetch_all(MYSQLI_ASSOC));
            break;

        // POST: Menambahkan mahasiswa
        case "POST":
            $data = getInput();
            [$nim, $nama, $email] = validateInput($data);

            $stmt = $conn->prepare(
                "INSERT INTO mahasiswa (nim, nama, email)
                 VALUES (?, ?, ?)"
            );
            $stmt->bind_param("sss", $nim, $nama, $email);
            $stmt->execute();

            response(201, "Mahasiswa berhasil ditambahkan", [
                "id" => $conn->insert_id,
                "nim" => $nim,
                "nama" => $nama,
                "email" => $email
            ]);
            break;

        // PUT: Mengubah mahasiswa
        case "PUT":
            if ($id === null) {
                response(400, "ID mahasiswa wajib disertakan");
            }

            $data = getInput();
            [$nim, $nama, $email] = validateInput($data);

            $stmt = $conn->prepare(
                "UPDATE mahasiswa
                 SET nim = ?, nama = ?, email = ?
                 WHERE id = ?"
            );
            $stmt->bind_param("sssi", $nim, $nama, $email, $id);
            $stmt->execute();

            if ($stmt->affected_rows === 0) {
                $check = $conn->prepare(
                    "SELECT id FROM mahasiswa WHERE id = ?"
                );
                $check->bind_param("i", $id);
                $check->execute();

                if (!$check->get_result()->fetch_assoc()) {
                    response(404, "Mahasiswa tidak ditemukan");
                }
            }

            response(200, "Data mahasiswa berhasil diperbarui", [
                "id" => (int)$id,
                "nim" => $nim,
                "nama" => $nama,
                "email" => $email
            ]);
            break;

        // DELETE: Menghapus mahasiswa
        case "DELETE":
            if ($id === null) {
                response(400, "ID mahasiswa wajib disertakan");
            }

            $stmt = $conn->prepare(
                "DELETE FROM mahasiswa WHERE id = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();

            if ($stmt->affected_rows === 0) {
                response(404, "Mahasiswa tidak ditemukan");
            }

            response(200, "Mahasiswa berhasil dihapus");
            break;

        default:
            header("Allow: GET, POST, PUT, DELETE");
            response(405, "HTTP Method tidak diizinkan");
    }

} catch (mysqli_sql_exception $e) {
    if ((int)$e->getCode() === 1062) {
        response(409, "NIM sudah terdaftar");
    }

    response(500, "Terjadi kesalahan pada database");
}
?>
