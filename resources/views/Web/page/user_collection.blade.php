<div id="uid">
  <ul class="Collect_list">
  @foreach($data as $row)
   <li>
   <div class="Collect_pro_name">
     <a href="/del_collection/{{$row->id}}" class="delete_Collect"></a>
    <p class="img center">
    <a href="/Product_detailed/{{$row->id}}"><img src= @if(empty($row->pic)) "/static/web/images/product_img_17.png" @else {{$row->pic}} @endif  width="180px" height="180px"/></a></p>
    <p><a href="/Product_detailed/{{$row->id}}">{{$row->goods_name}}</a></p>
    <p class="Collect_price">￥{{$row->price}}</p>
    </div>
   </li>
  @endforeach
  </ul>
</div>