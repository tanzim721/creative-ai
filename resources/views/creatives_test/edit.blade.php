<style>
    .container {
        margin: 5px auto;
        max-width: 900px;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .upload-section {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .upload-box {
        width: 32%;
        background-color: #f0f0f0;
        border: 2px dashed #ddd;
        padding: 20px;
        text-align: center;
        border-radius: 8px;
    }

    .upload-box input {
        display: none;
    }

    .upload-box:hover {
        background-color: #e6e6e6;
    }

    .generate-button {
        display: block;
        padding: 12px;
        background-color: #238cf5;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    .generate-button:hover {
        background-color: #0b5fa3;
    }

    .image-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 5px 0;
    }

    .delete-btn {
        cursor: pointer;
        color: red;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex">
        <div class="flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <form action="{{ route('creative.update', $creative->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col items-center mb-6">
                        <h2 class="text-3xl font-bold">Edit Ad</h2>
                        <p class="text-center">Edit your ad, and explore different ad variations tailored to various layouts.</p>
                    </div>

                    <!-- Ad Size Selection -->
                    <div class="form-section">
                        <label for="size">Size (px):</label>
                        <input type="number" placeholder="Width" value="{{ $creative->width }}" style="width: 75px; border-radius: 5px;" name="width"> X 
                        <input type="number" placeholder="Height" value="{{ $creative->height }}" style="width: 75px; border-radius: 5px;" name="height">
                    </div>

                    <!-- Upload Section -->
                    <div class="upload-section">
                        <!-- Main Asset Upload -->
                        <div class="upload-box">
                            <label for="main-asset">
                                <div class="input-box">
                                    <input type="file" id="main-asset" multiple name="main_asset[]">
                                    <button class="upload-btn">Upload Main Asset</button>
                                    <p style="color: rgba(0,0,0,0.5);">Supported types: jpg, png, svg, webp</p>
                                </div>
                            </label>
                            <div id="main-asset-preview">
                                @foreach ($creative->mainAssets as $asset)
                                    <div class="image-item">
                                        <span>{{ $asset->name }}</span>
                                        <span class="delete-btn" onclick="removeFile('main-asset', {{ $loop->index }})">&times;</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Logo Upload -->
                        <div class="upload-box">
                            <label for="logo-asset">
                                <div class="input-box">
                                    <input type="file" id="logo-asset" name="logo_asset">
                                    <button class="upload-btn">Upload Logo</button>
                                    <p style="color: rgba(0,0,0,0.5);">Supported types: jpg, png, svg, webp</p>
                                </div>
                            </label>
                            <div id="logo-asset-preview">
                                @if ($creative->logoAsset)
                                    <div class="image-item">
                                        <span>{{ $creative->logoAsset->name }}</span>
                                        <span class="delete-btn" onclick="removeFile('logo-asset', 0)">&times;</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- CTA Upload -->
                        <div class="upload-box">
                            <label for="cta-asset">
                                <div class="input-box">
                                    <input type="file" id="cta-asset" name="cta_asset">
                                    <button class="upload-btn">Upload CTA</button>
                                    <p style="color: rgba(0,0,0,0.5);">Supported types: jpg, png, svg, webp</p>
                                </div>
                            </label>
                            <div id="cta-asset-preview">
                                @if ($creative->ctaAsset)
                                    <div class="image-item">
                                        <span>{{ $creative->ctaAsset->name }}</span>
                                        <span class="delete-btn" onclick="removeFile('cta-asset', 0)">&times;</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                    </div>

                    <button class="generate-button">Update Ad</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function handleFileUpload(inputId, previewId, multiple = true) {
        const input = document.getElementById(inputId);
        const previewContainer = document.getElementById(previewId);

        input.addEventListener('change', function() {
            const files = Array.from(input.files);
            previewContainer.innerHTML = ''; // Clear previous previews

            files.forEach((file, index) => {
                const imageItem = document.createElement('div');
                imageItem.className = 'image-item';
                imageItem.innerHTML = `
                    <span>${file.name}</span>
                    ${multiple ? `<span class="delete-btn" onclick="removeFile('${inputId}', ${index})">&times;</span>` : ''}
                `;
                previewContainer.appendChild(imageItem);
            });
            
        });
    }

    function removeFile(inputId, index) {
        const input = document.getElementById(inputId);
        const dataTransfer = new DataTransfer(); // Create a new DataTransfer object

        // Copy existing files, except the one we want to remove
        for (let i = 0; i < input.files.length; i++) {
            if (i !== index) {
                dataTransfer.items.add(input.files[i]);
            }
        }

        input.files = dataTransfer.files; // Assign new file list
        handleFileUpload(inputId, previewId, inputId === 'main-asset'); // Refresh the preview
    }

    // Initialize file uploads
    handleFileUpload('main-asset', 'main-asset-preview');
    handleFileUpload('logo-asset', 'logo-asset-preview', false);
    handleFileUpload('cta-asset', 'cta-asset-preview', false);
</script>

