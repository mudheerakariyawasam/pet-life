function onLoad() {
  var url = new URL(window.location.href);
  var searchText = url.searchParams.get("searchQuery");
  var searchDate = url.searchParams.get("dateFilter[]");
  var allBtn = document.getElementById("btn-all-treatments");
  if (searchText != null) {
    allBtn.style.visibility = "visible";
    toggleExpand(true);
  } else {
    allBtn.style.visibility = "hidden";
    toggleExpand(false);
  }
  if (searchDate != null) {
    allBtn.style.visibility = "visible";
    toggleExpand(false);
  }

  highlight(searchText);
  var searchInput = document.getElementById("input-search");
  searchInput.addEventListener("keydown", function (e) {
    if (e.code === "Enter") {
      textSearch();
    }
  });
}

function expandRow(x) {
  var table = document.getElementById("myTable3");
  var rows = table.getElementsByTagName("tr");
  var expandRow = x.closest("tr").rowIndex + 1;
  var currentRow = table.rows[expandRow];
  var expandContent = currentRow.getElementsByClassName("expand-content")[0];

  expandContent.style.height = expandContent.style.height == "" ? "140px" : "";
  x.style.color =
    expandContent.style.height == "140px" ? "rgb(0 234 255)" : "#56afbbb0";
}

function textSearch(type) {
  var url = window.location.origin + window.location.pathname;
  if (type == "all") {
    location.href = url;
    return;
  }

  var searchText = document.getElementById("input-search").value;
  if (searchText != "") {
    location.href = url + "?searchQuery=" + searchText;
  }
}

function dateFilterValidate(startDate, endDate, tDate, fDate) {
  var errorMessage = "";
  document.getElementById("c-error-panel").innerHTML = errorMessage;

  if (!(tDate.checked || fDate.checked)) {
    errorMessage = "Please select one of checkboxes";
    showError();
    return false;
  }
  var toggle = document.getElementById("toggle").checked;
  if (startDate.value == "") {
    if (toggle) {
      errorMessage = "Please select the start date";
      showError();
      return false;
    } else {
      errorMessage = "Please select the specific date";
      showError();
      return false;
    }
  } else if (toggle && endDate.value == "") {
    errorMessage = "please select the end date";
    showError();
    return false;
  } else if(toggle && startDate.value != '' && endDate.value != '' && endDate.value < startDate.value) {
    errorMessage = 'start date must be come first!';
    showError();
    return false;
  }


  function showError() {
    if (errorMessage != "") {
      document.getElementById("c-error-panel").innerHTML = errorMessage;
    }
  }

  return true;
}

function dateSearch() {
  var startDate = document.getElementById("start-date");
  var endDate = document.getElementById("end-date");
  var tDate = document.getElementById("ct-date");
  var fDate = document.getElementById("cf-date");
  var state = "";

  if (!dateFilterValidate(startDate, endDate, tDate, fDate)) {
    return;
  }
  if (tDate.checked && fDate.checked) {
    state = "3";
  } else if (tDate.checked) {
    state = "2";
  } else if (fDate.checked) {
    state = "1";
  }
  if (startDate.value) {
    var url = window.location.origin + window.location.pathname;
    if (endDate.value == "") {
      location.href =
        url + "?dateFilter[]=" + startDate.value + "&dateFilter[]=" + state;
    } else {
      location.href =
        url +
        "?dateFilter[]=" +
        startDate.value +
        "&dateFilter[]=" +
        endDate.value +
        "&dateFilter[]=" +
        state;
    }
  }
}

function toggleExpand(toggle) {
  var expand = document.getElementById("btn-expand");
  var collapse = document.getElementById("btn-collapse");

  expand.style.display = !toggle ? "inherit" : "none";
  collapse.style.display = toggle ? "inherit" : "none";

  var rows = document.getElementsByClassName("expand-content");
  var icons = document.getElementsByClassName("expand-icon");
  [].forEach.call(rows, function (row) {
    row.style.height = toggle ? "140px" : "";
  });
  [].forEach.call(icons, function (icon) {
    icon.style.color = toggle ? "rgb(0 234 255)" : "#56afbbb0";
  });
}

function searchCalendar() {
  var calendarFilter = document.getElementById("calendar-filter");
  var toggleBtn = document.getElementById("toggle-label");

  calendarFilter.style.width =
    calendarFilter.style.width == "400px" ? "0" : "400px";
  calendarFilter.style.height =
    calendarFilter.style.height > "200px" ? "0" : "300px";
  calendarFilter.style.visibility =
    calendarFilter.style.visibility == "visible" ? "hidden" : "visible";
  toggleBtn.style.display =
    toggleBtn.style.display == "inline-block" ? "none" : "inline-block";

  dateRangeChange();

  // setTimeout(() => {
  //     calendarFilter.style.width == '400px' ? document.getElementById("c-calendar-left").showPicker() : '';
  // }, 200);
}

function clickCalendar() {
  // document.getElementById("c-calendar-left").showPicker();
}

function dateRangeChange() {
  if (document.getElementById("toggle").checked) {
    document.getElementById("label-start").innerHTML =
      "<i class='fa-solid fa-calendar-plus' style='margin-right: 8px;'></i>select start date";
    document.getElementById("c-datepicker-end").style.display = "flex";
    document.getElementById("calendar-filter").style.height = "300px";
  } else {
    document.getElementById("label-start").innerHTML =
      "<i class='fa-solid fa-calendar-days' style='margin-right: 8px;'></i>select specific date";
    document.getElementById("c-datepicker-end").style.display = "none";
    document.getElementById("calendar-filter").style.height = "270px";
  }
}

function highlight(text) {
  var inputText = document.getElementById("myTable3");
  var innerHTML = inputText.innerHTML;
  var index = innerHTML.indexOf(text);
  if (index >= 0) {
    innerHTML =
      innerHTML.substring(0, index) +
      "<span class='highlight'>" +
      innerHTML.substring(index, index + text.length) +
      "</span>" +
      innerHTML.substring(index + text.length);
    inputText.innerHTML = innerHTML;
  }
}

function toaster() {
  const button = document.querySelector("#notify-btn"),
    toast = document.querySelector(".toast");
  (closeIcon = document.querySelector(".close")),
    (progress = document.querySelector(".progress"));

  let timer1, timer2;

  function showNotification() {
    toast.classList.add("active");
    progress.classList.add("active");

    timer1 = setTimeout(() => {
      toast.classList.remove("active");
    }, 3000);

    timer2 = setTimeout(() => {
      progress.classList.remove("active");
    }, 3300);
  }

  closeIcon.addEventListener("click", () => {
    toast.classList.remove("active");

    setTimeout(() => {
      progress.classList.remove("active");
    }, 300);

    clearTimeout(timer1);
    clearTimeout(timer2);
  });
}

function sortTable(n, id) {
  var table,
    rows,
    switching,
    i,
    x,
    y,
    shouldSwitch,
    dir,
    switchcount = 0;
  table = document.getElementById(id);
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
    no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
        first, which contains table headers):*/
    for (i = 1; i < rows.length - 1; i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
            one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
      if (n == "0") {
        if (dir == "asc") {
          if (
            parseFloat(x.innerHTML.toLowerCase()) >
            parseFloat(y.innerHTML.toLowerCase())
          ) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (
            parseFloat(x.innerHTML.toLowerCase()) <
            parseFloat(y.innerHTML.toLowerCase())
          ) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      } else {
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount++;
    } else {
      /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
