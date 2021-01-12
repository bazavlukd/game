@extends('layouts.app')
@section('content')
@endsection

<script type="module">

import define from "/js/example2/index.js";
import {Runtime, Library, Inspector} from "/js/example2/runtime.js";

const runtime = new Runtime();
const main = runtime.module(define, Inspector.into(document.body));

</script>