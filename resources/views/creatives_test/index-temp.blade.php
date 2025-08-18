@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative')

@section('content')
    <x-app-layout>
        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
            <div class="dashboard">
                <div class="header bg-[#2D3A43]">Create creative with AI</div>
                <div class="dashboard_main contain overflow-x-hidden">
                    <form action="{{ route('creative.store') }}" method="POST" enctype="multipart/form-data" id="creativeForm">
                        @csrf
                        <div class="scroll-container mt-2">
                            <div class="d-flex flex-col align-items-start"
                                style="opacity: 0; transition: opacity 1.5s ease-in-out;">
                                <div>
                                    <p class="gradient_border bg-transparent chat_box"
                                        style="animation: fadeIn 1.5s ease-in-out forwards;">Hello,
                                        Welcome to Toucan<br>
                                    </p>

                                    <div class="d-flex align-items-center text-right justify-content-start animate__animated animate__fadeInLeft"
                                        style="animation-delay: 0.2s;" id="">
                                        <div class="mt-2 bg-transparent gradient_border chat_box">
                                            <p class="text-left">Please select one?</p>
                                            <div class="flex gap-2 mt-2">
                                                <button type="button" class="border px-3 py-1 rounded-md hover:bg-blue-500"
                                                    id="userChoseSelectTemplate">Select Template</button>
                                                <button type="button" class="border px-3 py-1 rounded-md hover:bg-blue-500"
                                                    id="userChoseGenerateImage">Generate Image with AI</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex justify-end d-none" id="userSelectedCommand">
                                <div class="text-right inline-block" id="">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInRight">
                                        <p id="dynamicTextOnUserSelectedCommand"></p>
                                    </div>
                                </div>
                            </div>

                            <div id="selectTemplateContainer" class="d-none">
                                <!-- Template Select -->
                                <div class="gradient_border inline-block bg-transparent chat_box mt-2 animate__animated animate__fadeInLeft d-none"
                                    id="selectTemplate">
                                    <p class="py-2" style="color: white">Select Template from below:</p>
                                    <div class="dropdown mb-2 text-black w-72">

                                        <select id="assetTypeDropdown" name="creative_type_id"
                                            class="bg-transparent text-white" style="border-radius: 5px; width: 100%;">
                                            <option class="text-black" value="">Select Creative Type</option>

                                            @foreach ($creative_types as $creative_type)
                                                <option class="text-black" value="{{ $creative_type->id }}"
                                                    {{ old('asset_type') == $creative_type->name ? 'selected' : '' }}>
                                                    {{ $creative_type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="cta_name" id="assetType">
                                    </div>
                                </div>

                                <div class="d-flex align-items-center text-right justify-content-end mt-2">
                                    <div>
                                        <p class="gradient_border bg-transparent chat_box animate__animated animate__fadeInRight"
                                            id="selectedTemplate" style="display: none;"></p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center text-right justify-content-end mt-2">
                                    <div>
                                        <p class="gradient_border bg-transparent chat_box animate__animated animate__fadeInRight d-none"
                                            id="playableAdsTemplate">Please Select Your Playable Ads Template</p>
                                    </div>
                                </div>

                                <div class="gradient_border inline-block bg-transparent chat_box mt-2 animate__animated animate__fadeInLeft d-none"
                                    id="playableAdsTemplateType">
                                    <p class="py-2" style="color: white">Select Game From Below:</p>
                                    <div class="dropdown mb-2 text-black w-72">

                                        <select id="playableAdsTemplateTypeDropdown" name="game_type_id"
                                            class="bg-transparent text-white" style="border-radius: 5px; width: 100%;">
                                            <option class="text-black" value="">Select Game Type</option>
                                            {{-- <option class="text-black" value="game1">
                                                Game 1
                                            </option>
                                            <option class="text-black" value="game2">
                                                Game 2
                                            </option>
                                            <option class="text-black" value="game3">
                                                Game 3
                                            </option>
                                            <option class="text-black" value="game4">
                                                Game 4
                                            </option> --}}
                                            @foreach ($game_types as $game_type)
                                                <option class="text-black" value="{{ $game_type->id }}"
                                                    {{ old('asset_type') == $game_type->name ? 'selected' : '' }}>
                                                    {{ $game_type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="cta_name" id="assetType">
                                    </div>
                                </div>

                                <div class="upload-section gradient_border inline-block bg-transparent text-white mt-2 d-none"
                                    id="inputSection2">
                                    <div class="upload-box bg-transparent text-white">
                                        <label for="main-asset">
                                            <div class="input-box animate__animated animate__fadeInLeft"
                                                style="animation-delay: 0.15s;">
                                                <p class="" style="color: white" id="uploadMainAsset2"></p>
                                                <input type="file" id="video"
                                                    class="rounded-3xl px-4 bg-[#0C2C57] border-blue-500 mt-2 py-1" multiple
                                                    name="video[]" accept="video/*">

                                                <p class="text-sm pl-6" id="main-asset-error2"></p>

                                                <div class="file-list gradient_border bg-transparent mt-2 d-none animate__animated animate__fadeIn"
                                                    id="file-list2"></div>
                                            </div>
                                        </label>
                                        <div id="main-asset-preview2"></div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center text-right justify-content-end mt-2">
                                    <div>
                                        <p class="gradient_border bg-transparent chat_box animate__animated animate__fadeInRight d-none"
                                            id="selectedTemplate3">Now Select Images</p>
                                    </div>
                                </div>

                                <div id="imageuploadchoice"
                                    class="d-flex align-items-center text-right justify-content-start animate__animated animate__fadeInLeft d-none"
                                    style="animation-delay: 0.2s;" id="">
                                    <div class="mt-2 bg-transparent gradient_border chat_box">
                                        <p class="text-left">What do you want?</p>
                                        <div class="flex gap-2 mt-2">
                                            <button type="button" class="border px-3 py-1 rounded-md hover:bg-blue-500"
                                                id="userChosemenualupload">Manual Image Upload</button>
                                            <button type="button" class="border px-3 py-1 rounded-md hover:bg-blue-500"
                                                id="userChoseGenerateImageUpload">Generate Image with AI</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center text-right justify-content-end mt-2">
                                    <div>
                                        <p class="gradient_border bg-transparent chat_box animate__animated animate__fadeInRight d-none"
                                            id="dimensionSelect">Please Select Your Dimension</p>
                                    </div>
                                </div>
                                <div class="gradient_border inline-block bg-transparent chat_box mt-2 animate__animated animate__fadeInLeft d-none"
                                    id="dimensionSelectType">
                                    <p class="py-2" style="color: white">Select Dimension from below:</p>
                                    <div class="dropdown mb-2 text-black w-72">
                                        <select id="dimensionSelectTypeDropdown" name="dimension_type_id"
                                            class="bg-transparent text-white" style="border-radius: 5px; width: 100%;">
                                            <option class="text-black" value="">Select Dimension</option>
                                            <option class="text-black" value="all">
                                                All
                                            </option>
                                            <option class="text-black" value="horizontal">
                                                Horizontal
                                            </option>
                                            <option class="text-black" value="vertical">
                                                Vertical
                                            </option>
                                            <option class="text-black" value="square">
                                                Square
                                            </option>
                                        </select>
                                        <input type="hidden" name="cta_name" id="assetType">
                                    </div>
                                </div>

                                <div id="promtBoxContainer2" class="d-none">
                                    <div class="d-flex align-items-center text-right justify-content-end">
                                        <div
                                            class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInRight">
                                            <p>Generate Images with AI</p>
                                        </div>
                                    </div>
                                    <!-- Changed to a div instead of a form to prevent page reload -->
                                    <div id="aiGenerationForm">
                                        <!-- Removed form tag and action attribute -->
                                        <div class="d-flex align-items-center text-right justify-content-start mt-2"
                                            id="promtBox2">
                                            <div class="bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft"
                                                style="animation-delay: 0.15s;">
                                                <p>Give your prompt below:</p>
                                                <div class="flex flex-col">
                                                    <textarea class="border-2 min-h-24 border-blue-700 rounded-lg px-2 py-1 mt-2 bg-blue-200 text-black w-80"
                                                        id="question2" name="question" placeholder="Enter your prompt here..." aria-label="Prompt Input"
                                                        oninput="updateCharCount2()"></textarea>
                                                    <p id="charCount2" class="text=sm text-gray-700 mt-1">0 / 30
                                                        characters required</p>
                                                    <button type="button"
                                                        class="border px-2 py-1 rounded-md hover:bg-blue-500 mt-2"
                                                        id="submitPrompt2">Submit Prompt</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 flex-wrap align-items-center justify-content-end mt-2 d-none"
                                        id="generatedImage2">
                                        <!-- Generated images will be inserted here via JavaScript -->
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-end d-none"
                                        id="generatedImage3">
                                        
                                    </div>



                                    <div class="w-full text-right text-red-500 py-2 d-none" id="aiImageError">
                                        <h1 id="aiImageErrorMsg"></h1>
                                    </div>

                                    <div class="d-flex align-items-center text-right justify-content-end d-none"
                                        id="imageLoading2">
                                        <div class="w-56 h-44 mt-2 bg-transparent gradient_border chat_box flex flex-col items-center justify-center animate__animated animate__fadeInRight py-4"
                                            style="animation-delay: 0.15s;">
                                            <div class="loader"></div>
                                            <h1 class="mt-3" id="loadingMSG2">Generating...</h1>
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-end">
                                        <button type="button"
                                            class="border px-8 py-1 rounded-md hover:bg-blue-500 my-2 text-white d-none"
                                            id="next_btn">Next</button>
                                    </div>
                                </div>

                                <div class="upload-section gradient_border inline-block bg-transparent text-white mt-2 d-none"
                                    id="inputSection">
                                    <div class="upload-box bg-transparent text-white">
                                        <label for="main-asset">
                                            <div class="input-box animate__animated animate__fadeInLeft"
                                                style="animation-delay: 0.1s;">
                                                <p class="" style="color: white" id="uploadMainAsset"></p>
                                                <input type="file" id="image"
                                                    class="rounded-3xl px-4 bg-[#0C2C57] border-blue-500 mt-2 py-1"
                                                    multiple name="image[]" accept="image/*">

                                                <p class="text-sm pl-6 d-none" id="main-asset-error"></p>

                                                <div class="file-list gradient_border bg-transparent mt-2 d-none animate__animated animate__fadeIn"
                                                    id="file-list"></div>
                                            </div>
                                        </label>
                                        <div id="main-asset-preview"></div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center text-right justify-content-end">
                                    <div>
                                        <p class="bg-transparent gradient_border chat_box animate__animated animate__fadeInRight d-none"
                                            style="animation-delay: 0.2s" id="contentText">You have selected an your
                                            asset
                                        </p>
                                    </div>
                                </div>

                                <!-- Do you want to input text -->
                                <div class="d-flex align-items-center text-right justify-content-start animate__animated animate__fadeInLeft d-none"
                                    style="animation-delay: 0.2s;" id="inputTextSection">
                                    <div class="mt-2 bg-transparent gradient_border chat_box">
                                        <p class="">Do you want to input text?</p>
                                        <div class="flex gap-2 mt-2">
                                            <button type="button" class="border px-3 py-1 rounded-md hover:bg-blue-500"
                                                id="textInputYes">Yes</button>
                                            <button type="button" class="border px-3 py-1 rounded-md hover:bg-blue-500"
                                                id="textInputNo">No</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Inter Your Text -->
                                <div class="d-flex align-items-center text-right justify-content-start d-none"
                                    id="inputTextContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft">
                                        <p class="">Write your text below:</p>
                                        <div>
                                            <input
                                                class="border-2 border-blue-700 rounded-lg px-2 py-1 mt-2 bg-blue-200 text-black"
                                                type="text" id="inputText" name="content"
                                                placeholder="Enter text here" />
                                            <button type="button"
                                                class="border px-2 py-1 rounded-md hover:bg-blue-500 mt-2"
                                                id="inputTextSubmit">&#8594;</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- User's Input Text Container -->
                                <div class="d-flex align-items-center text-right justify-content-end d-none"
                                    id="inputTextContainer2">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInRight">
                                        <p>Your input has been received.</p>
                                        <p id="userInputText"></p>
                                    </div>
                                </div>

                                <!-- Choose CTA Button Container -->
                                <div class="d-flex align-items-center text-right justify-content-start d-none"
                                    id="CTAButtonContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft">
                                        <p class="">Select CTA Button:</p>
                                        <div class="flex gap-2">

                                            <select name="ctaButton"
                                                class="rounded-md px-4 border-[#3276ceb2] py-1 mt-2  bg-blue-500 text-sm hover:scale-105 transition ease-in-out duration-150"
                                                onchange="chooseCTAButton(this.value)">
                                                <option class="bg-gray-200 text-white hover:bg-gray-400">Select CTA
                                                </option>
                                                <option value="BUY NOW" class="bg-blue-500 text-white">BUY NOW
                                                </option>
                                                <option value="CLICK" class="bg-blue-500 text-white">CLICK</option>
                                                <option value="PLAY" class="bg-blue-500 text-white">PLAY</option>
                                                <option value="WATCH" class="bg-blue-500 text-white">WATCH</option>
                                                <option value="VIEW" class="bg-blue-500 text-white">VIEW</option>
                                                <option value="WIN" class="bg-blue-500 text-white">WIN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- User's CTA Button Showing Container -->
                                <div class="d-flex align-items-center text-right justify-content-end d-none"
                                    id="inputCTAContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInRight">
                                        <div class="d-none flex flex-col items-start" id="videoSelected">
                                            <p>The button you chose is:</p>
                                            <button type="button"
                                                class="rounded-md px-4 border-[#3276ceb2] py-1 mt-2  bg-blue-500 text-sm hover:scale-105 transition ease-in-out duration-150"
                                                id="userInputCTA"></button>
                                        </div>

                                        <div id="ImagePreview" class="flex justify-center items-end pb-4 d-none"
                                            style="min-width: 300px; height: 250px; background-size: cover; background-repeat: no-repeat; background-position: center; border: 1px solid #ccc; border-radius: 7px; position: relative;">
                                            <div class="flex flex-col items-center pb-3">
                                                <p class="text-lg font-bold" id="campaignNameShow" draggable="true">
                                                </p>
                                                <button type="button"
                                                    class="rounded-md px-4 border-[#3276ceb2] py-1 my-2 bg-blue-500 text-sm hover:scale-105 transition ease-in-out duration-150"
                                                    id="userInputCTA2" draggable="true"></button>
                                            </div>

                                        </div>
                                        <div class="flex flex-col items-start mt-2 d-none" id="colorCodeContainer">
                                            <p class="d-none">Change Campaign Name's Color:</p>
                                            <div class="flex gap-2">
                                                <div id="color-picker"
                                                    class="bg-blue-500 px-4 py-1 gradient_border text-sm">
                                                    Change Color</div>
                                                <input type="number"
                                                    class="bg-blue-500 w-[158px] rounded-2xl pl-4 py-1 gradient_border text-sm text-white inline-block"
                                                    id="fontSizeInput" placeholder="Change Font Size" min="12" />
                                                <button type="button"
                                                    class="d-none border px-2 py-1 rounded-md hover:bg-blue-500 mt-2"
                                                    id="colorCodeSubmit">&#8594;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Inter Landing URL -->
                                <div class="d-flex align-items-center text-right justify-content-start d-none"
                                    id="interLandingURL">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft">
                                        <p class="">Input Landing URL:</p>
                                        <div>
                                            <input
                                                class="border-2 border-blue-700 rounded-lg px-2 py-1 mt-2 bg-blue-200 text-black"
                                                type="url" id="inputLandingURL" name="landing_url"
                                                placeholder="Enter URL here" />
                                            <button type="button"
                                                class="border px-2 py-1 mt-2 rounded-md hover:bg-blue-500"
                                                id="inputLandingURLSubmit">&#8594;</button>
                                        </div>
                                        <p class="mt-1 text-red-500 d-none" id="landingURLError">You have to must
                                            provide
                                            a
                                            Landing URL.</p>
                                    </div>
                                </div>

                                <!-- User's Input Landing URL Container -->
                                <div class="d-flex align-items-center text-right justify-content-end d-none"
                                    id="userLandingURLContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInRight">
                                        <p>Your Landing URL has been received.</p>
                                        <!-- <p id="userLandingURL"></p> -->
                                    </div>
                                </div>

                                <!-- Inter Tracking URL -->
                                <div class="d-flex align-items-center text-right justify-content-start d-none"
                                    id="interTrackingURL">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft">
                                        <p class="">Input Tracking URL:</p>
                                        <div>
                                            <input
                                                class="border-2 border-blue-700 rounded-lg px-2 py-1 mt-2 bg-blue-200 text-black"
                                                type="url" id="inputTrackingURL" name="tracking_url"
                                                placeholder="Enter URL here" />
                                            <button type="button"
                                                class="border px-2 py-1 mt-2 rounded-md hover:bg-blue-500"
                                                id="inputTrackingURLSubmit">&#8594;</button>
                                        </div>
                                        <p class="mt-1 text-red-500 d-none" id="trackingURLError">You have to must
                                            provide
                                            a
                                            Tracking URL.</p>
                                    </div>
                                </div>

                                <!-- User's Input Landing URL Container -->
                                <div class="d-flex align-items-center text-right justify-content-end d-none"
                                    id="userTrackingURLContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInRight">
                                        <p>Your Tracking URL has been received.</p>
                                        <!-- <p id="userTrackingURL"></p> -->
                                    </div>
                                </div>

                                <!-- Inter Creative Name -->
                                <div class="d-flex align-items-center text-right justify-content-start d-none"
                                    id="interCreativeNameContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft">
                                        <p class="">Give Creative Name:</p>
                                        <div>
                                            <input
                                                class="border-2 border-blue-700 rounded-lg px-2 py-1 mt-2 bg-blue-200 text-black"
                                                type="text" id="inputCreativeName" name="creative_name"
                                                placeholder="Enter name here" />
                                            <button type="button"
                                                class="border px-2 py-1 mt-2 rounded-md hover:bg-blue-500"
                                                id="inputCreativeNameSubmit">&#8594;</button>
                                        </div>
                                        <p class="mt-1 text-red-500 d-none" id="creativeNameError">You have to must
                                            provide a
                                            Creative Name.</p>
                                    </div>
                                </div>

                                <!-- User's Input Creative Name Container -->
                                <div class="d-flex align-items-center text-right justify-content-end d-none"
                                    id="userCreativeNameContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInRight">
                                        <p id="userCreativeName"></p>
                                    </div>
                                </div>

                                <!-- Generate Creative -->
                                <div class="d-flex align-items-center text-right justify-content-start d-none"
                                    id="generateCreativeContainer">
                                    <div
                                        class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft">
                                        <p class="">You are ready to go, Generate your Creative.</p>
                                        <div>
                                            <button type="submit"
                                                class="border px-3 py-1 mt-2 rounded-md bg-blue-500 hover:scale-105 transition ease-in-out duration-150">Generate
                                                Creative</button>
                                        </div>
                                    </div>
                                </div>

                            </div?>
                        </div>

                        <div class="d-flex align-items-center text-right justify-content-end py-3 pe-2">
                            <div>
                                <button class="btn btn-success" id="submitButton" type="submit" style="display:none;">
                                    Generate Creative
                                </button>
                            </div>
                        </div>
                    </form>


                    <div id="promtBoxContainer" class="{{ isset($imageUrl) || old('question') ? '' : 'd-none' }}">
                        <form id="creativeForm" action="{{ url('/creative') }}" method="GET">
                            <div class="d-flex align-items-center text-right justify-content-start" id="promtBox">
                                <div class="bg-transparent gradient_border chat_box flex flex-col items-start animate__animated animate__fadeInLeft"
                                    style="animation-delay: 0.15s;">
                                    <p>Give your prompt below:</p>
                                    <div class="flex flex-col">
                                        <textarea class="border-2 min-h-24 border-blue-700 rounded-lg px-2 py-1 mt-2 bg-blue-200 text-black w-80"
                                            id="question" name="question" value="{{ old('question', $question ?? '') }}"
                                            placeholder="Enter your prompt here..." aria-label="Prompt Input" oninput="updateCharCount()"></textarea>
                                        <p id="charCount" class="text=sm text-gray-700 mt-1">
                                            @if (old('question'))
                                                {{ strlen(old('question')) }}@else{{ 0 }}
                                            @endif / 30 characters required
                                        </p>
                                        <button type="submit" class="border px-2 py-1 rounded-md hover:bg-blue-500 mt-2"
                                            id="submitPrompt">Submit Prompt</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @if (!empty($imageUrls))
                            <div class="d-flex flex-wrap align-items-center justify-content-end" id="generatedImage">
                                @foreach ($imageUrls as $image)
                                    <div class="mt-2 bg-transparent gradient_border chat_box flex flex-col items-center animate__animated animate__fadeInRight py-4"
                                        style="animation-delay: 0.{{ $loop->index + 1 }}s; max-width: 270px; height: auto; margin: 10px; clip-path: inset(0 0 6% 0);"
                                        id="imageBox_{{ $loop->index }}">
                                        <img src="{{ $image['url'] }}" alt="{{ $image['style'] }} Image"
                                            class="object-cover rounded-lg shadow-lg border border-gray-200"
                                            style="width: 250px; height: auto; clip-path: inset(0 0 6% 0);" />

                                        <div class="flex justify-between mt-3 w-full">
                                            <!-- Download Button -->
                                            <a href="{{ $image['url'] }}"
                                                onclick="event.preventDefault(); downloadClippedImage('{{ $image['url'] }}', 'generated_{{ strtolower(str_replace(' ', '_', $image['style'])) }}')"
                                                class="border px-3 py-2 rounded-md hover:bg-blue-500 hover:text-white w-1/2 text-center block transition-all duration-300 ease-in-out">
                                                Download
                                            </a>

                                            <!-- Reject Button -->
                                            <button onclick="removeImage('imageBox_{{ $loop->index }}')"
                                                class="border px-3 py-2 rounded-md hover:bg-red-500 hover:text-white w-1/2 text-center block transition-all duration-300 ease-in-out ml-2">
                                                Reject
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="d-flex align-items-center text-right justify-content-end d-none" id="imageLoading">
                            <div class="w-56 h-44 mt-2 bg-transparent gradient_border chat_box flex flex-col items-center justify-center animate__animated animate__fadeInRight py-4"
                                style="animation-delay: 0.15s;">
                                <div class="loader"></div>
                                <h1 class="mt-3" id="loadingMSG">Generating...</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center h-screen">
                <p class="mt-4 text-2xl text-white">Your account is awaiting admin approval.</p>
                <p class="mt-2 text-2xl text-white">Need assistance? Contact us via email: <a
                        href="mailto:connect@adplay-mobile.com" class="text-white underline">connect@adplay-mobile.com</a>
                </p>
            </div>
        @endif
    </x-app-layout>
@endsection
