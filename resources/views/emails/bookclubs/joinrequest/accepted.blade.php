Hello {{ $name }} <br/><br/>
Your BookClub Joining request Accepted! <br/>
Congrats now you are member of {{ $bookClubName }} BookClub
<a href=' {{ route("bookclubs.show", $bookClubId) }}'>Click here to start browse {{ $bookClubName }}.</a>
