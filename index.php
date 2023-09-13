<?php

// Bitly APIのエンドポイントとAPIキーを設定
$api_endpoint = 'https://api-ssl.bitly.com/v4/shorten';
$api_key = 'b5dc802fb3de56eef4e5ba1076941d72b8fb6283';

// CORSの設定（必要に応じて適切なドメインを指定してください）
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");

// フォームから情報を取得
$data = file_get_contents("php://input");
$postData = json_decode($data);

$receiver = $postData->receiver;
$message = $postData->message;
$sender = $postData->sender;

// POSTリクエストで送信するデータを設定
$data = array(
    // 'long_url' => "https://dumdum0727.zombie.jp?receiver=しだ&message=ほげほげ&sender=ほげこ",
    'long_url' => "https://dumdum0727.zombie.jp?receiver={$receiver}&message={$message}&sender={$sender}",
);

// リクエストヘッダーを設定
$headers = array(
    'Authorization: Bearer ' . $api_key,
    'Content-Type: application/json',
);

// cURLを初期化
$ch = curl_init($api_endpoint);

// cURLオプションを設定
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// cURLリクエストを実行
$response = curl_exec($ch);
echo $response;

// エラーハンドリング
if ($response === false) {
    die('cURLエラー: ' . curl_error($ch));
}

// cURLセッションを閉じる
curl_close($ch);

return $response;
?>