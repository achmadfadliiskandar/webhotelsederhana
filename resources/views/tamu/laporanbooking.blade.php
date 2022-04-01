@foreach ($kamarorder->detailkamarorder as $item)
    {{$item->id}},
    {{$item->bookings_id}}
    {{$item->kamar_order_id}}
    {{$item->created_at}}
    {{$item->updated_at}}
@endforeach
{{-- {{$kamarorder->detailkamarorder}} --}}
{{-- {{$kamarorder->bookings}} --}}

{{Auth::user()->name}}