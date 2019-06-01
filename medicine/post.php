<?php

  $t = filter_input('t', 'GET');

?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <title>お薬手帳</title>
  </head>
  <body>
    <div class="container" style="padding-top: 50px;">
      <h2>お薬手帳アプリ</h2>
      <div class="jumbotron">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          お薬記録登録
        </button>
      </div>
    </div>
    <!-- モーダルの設定 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">お薬記録登録</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>お薬を飲みましたか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="y_modal">飲みました。</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="t" value="<?php echo htmlspecialchars($t); ?>">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script>
    const y_modal = document.getElementById('y_modal');
    y_modal.addEventListener('click', function(){

      const method = 'POST';
      //送信先を指定
      const url = 'https://dev-kokubun.herokuapp.com/medicine/postLineMessage.php?t=qeqweqwq' 
      const headers = {
        'Content-Type': 'application/x-www-form-urlencoded'
      };
      // 送信データを変換
      // const obj = jsondata //json形式
      // const body = Object.keys(obj).map((key)=>key+"="+encodeURIComponent(obj[key])).join("&");

      const options = { 
        method, 
        headers,
        // mode: 'cors',
        mode: 'cors'
        // body
      }
      fetch(url, options)
        .then(res => {
          //成功時の処理
          console.log(res);
        })
        .catch(err => {
          //エラー時の処理
          console.log(res);
        });
      });

  </script>
</html>