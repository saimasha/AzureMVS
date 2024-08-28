<style>
    .timeline-1 {
  border-left: 3px solid #b565a7;
  border-bottom-right-radius: 4px;
  border-top-right-radius: 4px;
  background: rgba(177, 99, 163, 0.09);
  margin: 0 auto;
  position: relative;
  padding: 50px;
  list-style: none;
  text-align: left;
  max-width: 40%;
}

@media (max-width: 767px) {
  .timeline-1 {
    max-width: 98%;
    padding: 25px;
    
  }
}

.timeline-1 .event {
  border-bottom: 1px dashed #000;
  padding-bottom: 25px;
  margin-bottom: 25px;
  position: relative;
}

@media (max-width: 767px) {
  .timeline-1 .event {
    padding-top: 30px;
  }
}

.timeline-1 .event:last-of-type {
  padding-bottom: 0;
  margin-bottom: 0;
  border: none;
}

.timeline-1 .event:before,
.timeline-1 .event:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline-1 .event:before {
  left: -207px;
  content: attr(data-date);
  text-align: right;
  font-weight: 100;
  font-size: 0.9em;
  min-width: 120px;
}

@media (max-width: 767px) {
  .timeline-1 .event:before {
    left: 0px;
    text-align: left;
  }
}

.timeline-1 .event:after {
  -webkit-box-shadow: 0 0 0 3px #b565a7;
  box-shadow: 0 0 0 3px #b565a7;
  left: -55.8px;
  background: #fff;
  border-radius: 50%;
  height: 9px;
  width: 9px;
  content: "";
  top: 5px;
}

@media (max-width: 767px) {
  .timeline-1 .event:after {
    left: -31.8px;
  }
}
</style>
<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      <div id="content">
        <ul class="timeline-1 text-black">
          <li class="event" data-date="1:00pm">
            <h4 class="mb-3">Login</h4>
            <p>Dealer</p>
          </li>
          <li class="event" data-date="4:00pm">
            <h4 class="mb-3 pt-3">Logout</h4>
            <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP &amp; Busta
              Rhymes as an opening show.</p>
          </li>
          <li class="event" data-date="8:00pm">
            <h4 class="mb-3 pt-3">Login</h4>
            <p>Stockist</p>
          </li>
          <li class="event" data-date="9:30pm">
            <h4 class="mb-3 pt-3">Logout</h4>
            <p class="mb-0">See how is the victor and who are the losers. The big stage is where the winners
              bask in their
              own glory.</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>














<!-- login -->

<!DOCTYPE html>

<html>
<head>
    <!-- <title>Login and Logout Timeline</title> -->
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- <div class="container">
        <h2>Login and Logout Timeline</h2>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username">
        </div>
        <button class="btn btn-primary" id="loginButton">Login</button>
        <button class="btn btn-secondary" id="logoutBtn" disabled>Logout</button>
        <hr>
        <ul class="list-group" id="timeline"></ul>
    </div> -->

    <!-- Include Bootstrap and jQuery JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>