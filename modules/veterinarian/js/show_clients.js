function search(event) {
  var url = window.location.origin + window.location.pathname;
  location.href =
        url + "?nic=" + event.target.textContent;
}

function getAll() {
  var url = window.location.origin + window.location.pathname;
  location.href = url;
}