<?php

// Bitly APIのエンドポイントとAPIキーを設定します
$api_endpoint = 'https://api-ssl.bitly.com/v4/shorten';
$api_key = 'b5dc802fb3de56eef4e5ba1076941d72b8fb6283';

// フォームから情報を取得する
// $receiver = $_POST["receiver"];
// $message = $_POST["message"];
// $sender = $_POST["sender"];

// POSTリクエストで送信するデータを設定します
$data = array(
    'long_url' => "https://dumdum0727.zombie.jp?receiver=しだ&message=ほげほげ&sender=ほげこ",
    // 'long_url' => "https://dumdum0727.zombie.jp?receiver={$receiver}&message={$message}&sender={$sender}",
);

// リクエストヘッダーを設定します
$headers = array(
    'Authorization: Bearer ' . $api_key,
    'Content-Type: application/json',
);

// cURLを初期化します
$ch = curl_init($api_endpoint);

// cURLオプションを設定します
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// cURLリクエストを実行します
$response = curl_exec($ch);
echo $response;

// エラーハンドリング
if ($response === false) {
    die('cURLエラー: ' . curl_error($ch));
}

// cURLセッションを閉じます
curl_close($ch);

return $response;

// レスポンスをJSONデコードします
// $result = json_decode($response, true);

// 短縮URLを取得します
// if (isset($result['link'])) {
//     $short_url = $result['link'];
//     echo $result;
//     echo '短縮URL: ' . $short_url;
//     return $response;
// } else {
//     return '何かしらうまくいきませんでした';
// }
?>