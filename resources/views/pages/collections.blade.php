<div class="">
    <p>{{$id}}</p>
    @foreach( $category->collections as $item)
        <a href="{{ route('products', ['id' => $id, 'collection' => $item]) }}"
           class="capitalize">{{$item}}</a>
    @endforeach

    @foreach($products as $product)
        <p>{{$product['name']}}</p>
    @endforeach

</div>
