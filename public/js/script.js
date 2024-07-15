document.addEventListener('DOMContentLoaded', function () {
  // ページが読み込まれた後に実行する関数を登録します

  // モーダルを開くボタンをすべて取得
  const modalOpenButtons = document.querySelectorAll('.js-modal-open');
  // モーダルを閉じるボタンをすべて取得
  const modalCloseButtons = document.querySelectorAll('.js-modal-close');
  // モーダル自体を取得
  const modal = document.querySelector('.js-modal');

  // 各モーダルを開くボタンにクリックイベントを設定
  modalOpenButtons.forEach(button => {
    button.addEventListener('click', function () {
      // ボタンのdata属性から投稿IDと投稿内容を取得
      const postId = this.dataset.postId;
      const postContent = this.dataset.postContent;

      // モーダル内のフォームに投稿IDと投稿内容をセット
      modal.querySelector('input[name="id"]').value = postId;
      modal.querySelector('textarea[name="post"]').value = postContent;

      // モーダルを表示
      modal.style.display = 'block';
    });
  });

  // 各モーダルを閉じるボタンにクリックイベントを設定
  modalCloseButtons.forEach(button => {
    button.addEventListener('click', function () {
      // モーダルを非表示にする
      modal.style.display = 'none';
    });
  });

  // ウィンドウ全体にクリックイベントを設定
  window.addEventListener('click', function (event) {
    // クリックイベントのターゲットがモーダルそのものであれば
    if (event.target == modal) {
      // モーダルを非表示にする
      modal.style.display = 'none';
    }
  });
});
