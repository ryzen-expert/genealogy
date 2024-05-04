<div>


    <div class= "group fixed bottom-11 mb-6 right-2 p-2  flex items-end justify-end w-24 h-24 z-30 ">
        <!-- main -->
        <div class = "text-white shadow-xl flex items-center justify-center p-3 rounded-full bg-gradient-to-r from-primary-900 to-blue-500 z-50 absolute  ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:rotate-90 transition  transition-all duration-[0.6s]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <!-- sub left -->
        <div class="absolute rounded-full transition-all duration-[0.2s] ease-out scale-y-0 group-hover:scale-y-100 group-hover:-translate-x-16   flex  p-2 hover:p-3   scale-100   text-white">
{{--            <x-ts-button.circle centralized icon="zoom-in" class="mx-10" color="orange" lg wire:click="zoomIn"/>--}}


            @if ($count === $count_min)

                <x-ts-button.circle centralized icon="minus" class="mx-10" color="orange" lg wire:click="decrement" disabled/>

{{--                <x-ts-button square xs color="danger" class="rounded-l border-0" wire:click="decrement" disabled>--}}
{{--                    <x-ts-icon icon="minus" class="size-5" />--}}
{{--                </x-ts-button>--}}
            @else

                <x-ts-button.circle centralized icon="minus" class="mx-10" color="orange" lg wire:click="decrement"  />

{{--                <x-ts-button square xs color="secondary" class="rounded-l border-0" wire:click="decrement">--}}
{{--                    <x-ts-icon icon="minus" class="size-5" />--}}
{{--                </x-ts-button>--}}
            @endif

        </div>


        <!-- sub top -->
        <div class="absolute rounded-full transition-all duration-[0.2s] ease-out scale-x-0 group-hover:scale-x-100 group-hover:-translate-y-16  flex  p-2 hover:p-3   text-white">

{{--            <x-ts-button.circle centralized icon="zoom-out"   color="orange" lg wire:click="zoomOut"/>--}}

            @if ($count === $count_max)

               <x-ts-button.circle centralized icon="plus"   color="orange" lg wire:click="increment" disabled/>


            @else

                <x-ts-button.circle centralized icon="plus"   color="orange" lg wire:click="increment"/>

{{--                <x-ts-button square xs color="secondary" class="rounded-r border-0" wire:click="zoomOut">--}}
{{--                    <x-ts-icon icon="plus" class="size-5" />--}}
{{--                </x-ts-button>--}}
            @endif


        </div>
        <!-- sub middle -->
{{--        <div class="absolute rounded-full transition-all duration-[0.2s] ease-out scale-x-0 group-hover:scale-x-100 group-hover:-translate-y-14 group-hover:-translate-x-14   flex  p-2 hover:p-3 bg-yellow-300 hover:bg-yellow-400 text-white">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />--}}
{{--            </svg>--}}
{{--        </div>--}}
    </div>

{{--    <div class="fixed bottom-10 left-10 items-center justify-end  mx-10 z-10 right-10 p-4     space-x-4 w-12">--}}
{{--    <div class="fixed bottom-11 left-[50%] right-[50%] pb-5   ">--}}
{{--        <!-- Buttons for actions -->--}}

{{--        <x-ts-number centralized  onchange="showVal(this.value)" />--}}


{{--        <x-ts-button.circle text="+" value=""  onchange="showVal(this.value)" />--}}
{{--            <div class="xflex-col-reverse xitems-center cz-60 xjustify-end my-auto">--}}
{{--                <input value="1"  onchange="showVal(this.value)">--}}

{{--                <input id="zoomLevel" type="text" value="1" class="hidden"> <!-- Hidden input to store the zoom level -->--}}

{{--                <x-ts-button.circle centralized icon="zoom-in" class="mx-10" color="orange" lg wire:click="zoomIn"/>--}}
{{--                <x-ts-button.circle centralized icon="zoom-out" class="mb-5" color="orange" lg wire:click="zoomOut"/>--}}


{{--            </div>--}}


{{--    </div>--}}


    <div class="flex flex-col rounded bg-white w-full shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 text-neutral-800 dark:text-neutral-50">
        <div class="h-14 min-h-min p-2 border-b-2 border-neutral-100 text-lg font-medium dark:border-neutral-600 dark:text-neutral-50 rounded-t">

            <div class="relative   z-10 xbg-red-500 shadow-lg">
{{--                <input class="absolute bottom-auto   w-full px-3.5   bottom-1"  min="1" max="20" value='{{ $zoomLevel }}' step="1" onchange="showVal(this.value)" type="range"/>--}}

{{--                                    <span>--}}
{{--                        <div class="inline-flex border rounded" role="group">--}}
{{--                            <x-ts-button square xs color="secondary" class="rounded-l border-0" wire:change="showVal(this.value)"  onchange="showVal(this.value)">--}}
{{--                                <x-ts-icon icon="zoom-out" class="size-5" />--}}
{{--                            </x-ts-button>--}}
{{--                            <div class="w-8 text-center">{{ $zoomLevel }}</div>--}}
{{--                            <x-ts-button square xs color="secondary" class="rounded-r border-0" wire:click="zoomIn" onchange="showVal(this.value)">--}}
{{--                                <x-ts-icon icon="zoom-in" class="size-5" />--}}
{{--                            </x-ts-button>--}}
{{--                        </div>--}}
{{--                    </span>--}}

            </div>

            <div class="flex flex-wrap gap-2  justify-center items-start">
{{--                <x-ts-range  class="bg-danger-600" label="Zoom" hint="Zoom" />--}}




                <div class="flex-grow min-w-max max-w-full flex-1">
                    <span class="mr-1">{{ __('person.descendants') }}</span>






                    {{--                    <span>--}}
{{--        <div class="inline-flex border rounded" role="group">--}}
{{--            <x-ts-button square xs color="secondary" class="rounded-l border-0" wire:click="zoomOut">--}}
{{--                <x-ts-icon icon="minus" class="size-5" />--}}
{{--            </x-ts-button>--}}
{{--            <div class="w-8 text-center">{{ $zoomLevel }}</div>--}}
{{--            <x-ts-button square xs color="secondary" class="rounded-r border-0" wire:click="zoomIn">--}}
{{--                <x-ts-icon icon="plus" class="size-5" />--}}
{{--            </x-ts-button>--}}
{{--        </div>--}}
{{--    </span>--}}



                    <div class="inline-flex border rounded" role="group">

                    @if ($count === $count_min)
                            <x-ts-button square xs color="danger" class="rounded-l border-0" wire:click="decrement" disabled>
                                <x-ts-icon icon="minus" class="size-5" />
                            </x-ts-button>
                        @else
                            <x-ts-button square xs color="secondary" class="rounded-l border-0" wire:click="decrement">
                                <x-ts-icon icon="minus" class="size-5" />
                            </x-ts-button>
                        @endif

                        <div class="w-8 text-center">{{ $count }}</div>

                        @if ($count === $count_max)
                            <x-ts-button square xs color="danger" class="rounded-r border-0" wire:click="increment" disabled>
                                <x-ts-icon icon="plus" class="size-5" />
                            </x-ts-button>
                        @else
                            <x-ts-button square xs color="secondary" class="rounded-r border-0" wire:click="increment">
                                <x-ts-icon icon="plus" class="size-5" />
                            </x-ts-button>
                        @endif



                    </div>


                </div>



{{--                <div class="main-container">--}}
{{--                    <div  class="maindiv">--}}
{{--                        asdas adsasda asdadss--}}
{{--                    </div>--}}
{{--                </div>--}}


                <div class="flex-grow min-w-max max-w-full flex-1 text-end">
                    <x-ts-icon icon="binary-tree" class="inline-block me-2" />
                </div>
            </div>
        </div>

        <div class="overflow-x-auto cmx-auto" dir="ltr">


            {{--            app()->getLocale()==='ar' ? 'tree-rtl' : 'tree-ltr'--}}
{{--            <div class="tree-ltr"  id="zoomableImage" style="transform: scale({{ $scale }}); transform-origin: {{ $origin }};">--}}
            <div class="tree-ltr"  id="zoomableImage"  >
                <ul>
{{--                    @dump($descendants);--}}
                    <x-tree-node.descendants :person="$person" :descendants="$descendants" :level_max="$count" />
                </ul>
            </div>

{{--            <div class="tree-rtl">--}}
{{--                <ul>--}}
{{--                    <x-tree-node.descendants :person="$person" :descendants="$descendants" :level_max="$count" />--}}
{{--                </ul>--}}
{{--            </div>--}}

        </div>
    </div>






    <script>


{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            showVal({{ $zoomLevel }});--}}
{{--        });--}}



        // function setZoom(zoom,el) {
        //
        //     transformOrigin = [0,0];
        //     el = el || instance.getContainer();
        //     var p = ["webkit", "moz", "ms", "o"],
        //         s = "scale(" + zoom + ")",
        //         oString = (transformOrigin[0] * 100) + "% " + (transformOrigin[1] * 100) + "%";
        //
        //     for (var i = 0; i < p.length; i++) {
        //         el.style[p[i] + "Transform"] = s;
        //         el.style[p[i] + "TransformOrigin"] = oString;
        //     }
        //
        //     el.style["transform"] = s;
        //     el.style["transformOrigin"] = oString;
        //
        // }

        //setZoom(5,document.getElementsByClassName('container')[0]);

        function showVal(a){
            // alert(a);
            var zoomScale = Number(a)/10;
            setZoom(zoomScale,document.getElementById('zoomableImage'))
        }


    </script>


   @push('styles')
        @php
          $css=   app()->getLocale()==='ar' ? 'tree-rtl' : 'tree-ltr';
        @endphp
{{--        <link href="{{ asset('css/'.$css) }}" rel="stylesheet">--}}
        <link href="{{ asset('css/tree-ltr.css') }}" rel="stylesheet">
{{--        <link href="{{ asset('css/tree-rtl.css') }}" rel="stylesheet">--}}
    @endpush

    <script>


        document.addEventListener('DOMContentLoaded', () => {
            function showVal(a){
                // alert(111);
                var zoomScale = Number(a)/10;
                setZoom(zoomScale,document.getElementById('zoomableImage'))
            }


            window.addEventListener('zoomChanged', event => {

                console.log('Event received:', event.detail);

                // Assuming event.detail is an object with a property 'zoomLevel'
                let zoomLevel = event.detail[0].zoomLevel;
                // alert(zoomLevel);
                if (!zoomLevel) {
                    console.error('Zoom level data is missing');
                    return;
                }

                // Calculate zoom scale from zoom level
                let zoomScale =Number(zoomLevel)/ 10;
                alert(zoomScale);
                // Access the DOM element
                let zoomableImage = document.getElementById('zoomableImage');
                if (!zoomableImage) {
                    console.error('Element #zoomableImage not found');
                    return;
                }

                // Apply CSS transforms and other styles
                // zoomableImage.style.transform = `scale(${zoomScale/ 10})`;
                zoomableImage.style.transform = `scale(${zoomScale})`;
                zoomableImage.style.transformOrigin = '0% 0% 0px';
                zoomableImage.style.backgroundColor = '#429595';

                // Optional: Debugging output
                console.log(`Zoom scale set to: ${zoomScale}`);

                console.log('zoomableImage style:', zoomableImage.style);
                // console.log('Event received:', event.detail[0].zoomLevel);
                // showVal( event.detail[0].zoomLevel);
                // document.getElementById('range').onchange(event.detail[0].zoomLevel);

                // document.getElementById('zoomableImage').style ='transform: scale(0.2);transform-origin: 0% 0% 0px;background-color: #429595;';
                // Call your JavaScript function here
                // yourCustomFunction(event.detail[0]);
                // var zoomScale = Number(event.detail[0].zoomLevel)/10;
                // alert(zoomScale);
                // alert(document.getElementById('range').value);
                // alert(document.getElementById('zoomableImage'));
                // setZoom(zoomScale,document.getElementById('zoomableImage'))

            });
        });

        // function yourCustomFunction(data) {
        //     console.log('Function called with data:', data.zoomLevel);
        //     // Implement your function's logic here
        // }


        function setZoom(zoom,el) {
            console.log('Function called with data:', zoom);
            console.log('Function called with data:', el);
            transformOrigin = [0,0];
            el = el || instance.getContainer();
            console.log('Function called with data:', el);

            var p = ["webkit", "moz", "ms", "o"],
                s = "scale(" + zoom + ")",
                oString = (transformOrigin[0] * 100) + "% " + (transformOrigin[1] * 100) + "%";
            console.log('Function called with ppp:', p);
            console.log('Function called with sss:', s);
            for (var i = 0; i < p.length; i++) {
                el.style[p[i] + "Transform"] = s;
                el.style[p[i] + "TransformOrigin"] = oString;
            }

            console.log('Function called with data:',el.style["transform"]);
            console.log('Function called with oString:', oString);

            el.style["transform"] = s;
            el.style["transformOrigin"] = oString;

        }

    </script>




</div>
