<!-- First row -->
@if(count($timezones)>0)
    @foreach($timezones as $data)

        @livewire('time-result', ['data'=>$data])


    @endforeach

@endif

