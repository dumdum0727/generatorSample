'use strict';

document.querySelector('.send').addEventListener('click', (e) => {
e.preventDefault();
  fetchFunc(); 
});

async function fetchFunc() {
  // フォームの情報を取得する
  const receiver = document.querySelector("input[name='receiver']").value;
  const message = document.querySelector("textarea[name='message']").value;
  const sender = document.querySelector("input[name='sender']").value;

  // PHPの送信先
  const url = 'http://localhost:3000/index.php';

  // 送信するデータを定義
  const data = {
    receiver: receiver,
    message: message,
    sender: sender
  };

  // POSTリクエストを送信
  const response = await fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  });
  // レスポンスのステータスコードをチェック
  if (response.status !== 200) {
    throw new Error(`HTTP エラー: ${response.status}`);
  }
  
  // レスポンスのデータを取得
  console.log(response)
  const json = await response.json();

  // レスポンスデータを表示
  console.log(json);
  document.querySelector('.original-url').innerHTML = `元URL: ${json['long_url']}`;
  document.querySelector('.short-url').innerHTML = `短縮URL: ${json['link']}`;
}