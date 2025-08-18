<x-app-layout>
    <div class="wrapper">
        <div class="main">
            <div class="header">Create creative with AI</div>
            <form action="{{ route('creative.store') }}" method="POST" enctype="multipart/form-data" id="creativeForm">
                @csrf
                <div class="scroll">
                    <div class="d-flex align-items-center" style="opacity: 0; transition: opacity 1.5s ease-in-out;">
                        <div>
                            <p class="msg" style="animation: fadeIn 1.5s ease-in-out forwards;">Hello, Welcome to AI
                                Creative Generator <br>
                                <button type="button" class="btn btn-primary btn-sm" id="createCreative"
                                    style="animation: fadeIn 1.5s ease-in-out forwards;">Create Creative</button>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectCreateCreative"></p>
                        </div>
                    </div>
                    <div class="form-section d-none" id="sizeSection">
                        <label for="size">Size (px):</label>
                        <div class="d-flex flex-wrap">
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="300x250">300x250</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="336x280">336x280</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="728x90">728x90</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="160x600">160x600</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="300x600">300x600</span>
                        </div>
                        <input type="hidden" name="width" id="width">
                        <input type="hidden" name="height" id="height">
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectSize"></p>
                        </div>
                    </div>
                    <div class="upload-section d-none" id="uploadMainAssetSection">
                        <div class="upload-box">
                            <label for="main-asset">
                                <div class="input-box">
                                    <p class="d-none" id="uploadMainAsset"></p>
                                    <input type="file" id="main-asset" class="" multiple name="main_asset[]"
                                        onchange="checkMainAssetInput()" required>
                                    <small class="form-text text-muted">Please select at least three images.</small>
                                </div>
                            </label>
                            <div id="main-asset-preview"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectMainAsset"></p>
                        </div>
                    </div>
                    <div class="upload-section d-none" id="uploadLogoAssetSection">
                        <div class="upload-box">
                            <label for="logo-asset">
                                <div class="input-box">
                                    <p class="d-none" id="uploadLogoAsset"></p>
                                    <input type="file" id="logo-asset" class="" multiple name="logo_asset">
                                </div>
                            </label>
                            <div id="logo-asset-preview"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectLogoAsset"></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center text-right justify-content-end py-3 pe-2">
                    <div>
                        <button class="btn btn-success d-none" id="submitButton" type="button"
                            onclick="submitForm()">
                            Generate Creative
                        </button>
                    </div>
                </div>
                
                <div id="showCreative" class="">
                    
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>
