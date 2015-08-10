Hello {{ $name }} <br/><br/>
BookClub Request Received! <br/>
{{ $requesteeName }} wants to borrow {{ $bookName }} in {{ $bookClubName }} BookClub
<a href='{{ url("/notifications") }}'>Click here to accept or reject request.</a>
