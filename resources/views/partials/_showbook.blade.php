<div class="media book-view ">
  <div class="media-left">
    <a href="{{route('books.show',$book->id)}}">
        <i class='fa fa-leanpub fa-4x book-default-pic'></i>
    </a>
  </div>
  <div class="media-body">
    <h3 class="media-heading">
      @if(isset($book_clickable))
        {!! link_to_route('books.show',$book->title,$book->id) !!}
      @else
        {{ $book->title }}
      @endif
    </h3>
    <small>
      by:
        @forelse($book->authors as $key => $author)
            @unless($key == 0) , @endunless
            {{$author->name}}
        @empty
          Not Available
        @endforelse
    </small>
    <p>Description: {{$book->description}}</p>
    <small>Language: {{$book->language->name}},</small>
    <small>Category: {{$book->category->name}},</small>
    <small>Status:
      @forelse($statuses as $count=>$status)
        {{ $status }} {{$count}}
      @empty
        None Available
      @endforelse
    </small>
  </div>

  <!-- START: Livefyre Embed -->
<div id="livefyre-comments"></div>
<script type="text/javascript" src="http://zor.livefyre.com/wjs/v3.0/javascripts/livefyre.js"></script>
<script type="text/javascript">
(function () {
    var articleId = fyre.conv.load.makeArticleId(null);
    fyre.conv.load({}, [{
        el: 'livefyre-comments',
        network: "livefyre.com",
        siteId: "376660",
        articleId: articleId,
        signed: false,
        collectionMeta: {
            articleId: articleId,
            url: fyre.conv.load.makeCollectionUrl(),
        }
    }], function() {});
}());
</script>
<!-- END: Livefyre Embed -->
            


</div>
