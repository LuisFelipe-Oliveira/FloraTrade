<?php 

function existeEmailNoBanco($conn, $email) {
    $sql_code = "SELECT COUNT(*) as count FROM usuario WHERE email = :email";
    $stmt = $conn->prepare($sql_code);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $sql_query = $stmt->fetch(PDO::FETCH_ASSOC);

    return $sql_query['count'] > 0;

}

function armazenarTokenNoBanco($conn, $email, $token, $timetoken) {
    $sql_code = "UPDATE usuario SET token = :token, timetoken = :timetoken WHERE email = :email";
    $stmt = $conn->prepare($sql_code);
    $stmt->bindParam(":token", $token, PDO::PARAM_STR);
    $stmt->bindParam(":timetoken", $timetoken, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function tokenEhValido($conn, $token) {
    $sql_code = "SELECT token, timetoken FROM usuario where token = :token";
    $stmt = $conn->prepare($sql_code);
    $stmt->bindParam(":token", $token, PDO::PARAM_STR);
    $stmt->execute();
    $sql_query = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($sql_query) {
        $timeToken = $sql_query['timetoken'];
        $lifeTimeToken = 3600;
        error_log("Achei um registro.");
        return (time() - $timeToken) < $lifeTimeToken;
    } else {
        error_log("Nenhum registro com esse token");
        return false;
    }
}

function atualizarSenhaNoBanco($conn, $token, $novaSenha) {
    $senha = md5($novaSenha);
    $sql_code = "UPDATE usuario SET senha = :senha where token = :token";
    $stmt = $conn->prepare($sql_code);
    $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
    $stmt->bindParam(":token", $token, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

?>