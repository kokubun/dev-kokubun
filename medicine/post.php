<?php

  $tp = filter_input(INPUT_GET, 'tp');
  $ta = filter_input(INPUT_GET, 'ta');
  $u = filter_input(INPUT_GET, 'u', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <title>お薬手帳</title>
  </head>
  <body>
    <div class="container" style="padding-top: 50px;">
      <h2>お薬手帳アプリ</h2>
      <div class="jumbotron">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mymodal">
          お薬記録登録
        </button>
      </div>
    </div>
    <!-- モーダルの設定 -->
    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodallabel">
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
            <div class="alert alert-danger" id="model_error" role="alert" style="display:none;">エラーが発生しました</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="y_modal">飲みました。</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">まだです。</button>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="tp" id="tp" value="<?php echo htmlspecialchars($tp); ?>">
    <input type="hidden" name="ta" id="ta" value="<?php echo htmlspecialchars($ta); ?>">
    <?php
      if ($u) {
        foreach ($u as $key => $value) {
          echo '<input type="hidden" name="u[]" class="u" value="'. htmlspecialchars($value) .'">';
        }
      }
    ?>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <script>
    const y_modal = document.getElementById('y_modal');
    y_modal.addEventListener('click', function(){
      _post();
    });

    $('#mymodal').on('hidden.bs.modal', function () {
      $('#model_error').hide();
    })


    /**
     * POST 
     * @return void
     */
    function _post() {
      const method = 'POST';
      //送信先を指定
      const url = 'https://dev-kokubun.herokuapp.com/medicine/postLineMessage.php' 
      const headers = {
        'Content-Type': 'application/x-www-form-urlencoded'
      };
      const tp = document.getElementById('tp').value;
      const ta = document.getElementById('ta').value;
      const u = document.querySelectorAll('input.u');
      let _u = '';

      if (u.length > 0) {
        for (let i = 0; i < u.length; i++) {
          _u += u[i].value+',';
        }
        _u = _u.slice(0, -1);
      }

      const jsondata = {
        'tp': tp,
        'ta': ta,
        'u': _u
      };

      // 送信データを変換
      const obj = jsondata;
      const body = Object.keys(obj).map((key)=>key+"="+encodeURIComponent(obj[key])).join("&");

      const options = { 
        method, 
        headers,
        mode: 'cors',
        body
      }
      fetch(url, options)
        .then(res => {
          //成功時の処理
          if (res.status == 200 && res.statusText == 'OK') {
            $('#mymodal').modal('hide');
          } else {
            $('#model_error').show();
          }
        })
        .catch(err => {
          //エラー時の処理
          console.log(res);
          $('#model_error').show();
        });

    }

  </script>
</html>