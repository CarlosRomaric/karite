<style>
    * {
        text-align: center;
        color: black !important;
    }
    .code {
        width: 70px;
        height: 40px;
        margin: 8px;
        display: block;
    }
    .qr {
        font-size: 8px;
        margin-top: 0px;
        display: inline-block;
        text-align: center;
    }
    div {
        text-align: center;
    }
</style>

@php
   use Picqer\Barcode\BarcodeGeneratorPNG;
@endphp

@foreach ($lot->sealeds as $sealed)
    <div class="qr">
        @php
            $generatorPNG = new BarcodeGeneratorPNG();
        @endphp
        <img class="code" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($sealed->code, $generatorPNG::TYPE_CODE_128)) }}"><br>
        {{$sealed->code}}
    </div>
@endforeach
<script type="text/php">
    if ( isset($pdf) ) {
        $x = 10;
        $y = 800;
        $text = "Lot N°{{$lot->number}} du badge N°{{$lot->batch->number}} assigné le {{date('d/m/Y H:i:s',strtotime($lot->updated_at))}} par {{$lot->user->fullname ?? ''}} - code lot: {{$lot->code ?? ''}} {{$lot->batch->region->name}}";
    	$font = '';
        $size = 8;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        $x = 550;
        $y = 800;
        $text =  "{PAGE_NUM} sur {PAGE_COUNT}";
        $pdf->page_text($x, $y,$text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
