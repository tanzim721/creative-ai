@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative - Support')

@section('content')
    <x-app-layout>
        <style>
            /* Support Chat Widget Styles */
            .support-widget {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            }

            /* Chat Window - Always visible and centered */
            .chat-window {
                position: fixed;
                top: 45%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 550px;
                min-width: 350px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                opacity: 1;
                visibility: visible;
                max-height: 90vh;
            }

            /* Chat Header */
            .chat-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 20px;
                text-align: center;
                position: relative;
                flex-shrink: 0;
            }

            .chat-header h3 {
                margin: 0 0 5px 0;
                font-size: 18px;
                font-weight: 600;
            }

            .chat-header p {
                margin: 0;
                font-size: 14px;
                opacity: 0.9;
            }

            /* Chat Body */
            .chat-body {
                padding: 20px;
                overflow-y: auto;
                flex: 1;
                max-height: calc(90vh - 100px);
            }

            /* Form Styles */
            .support-form {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .form-group {
                position: relative;
            }

            .form-group input,
            .form-group textarea {
                width: 100%;
                padding: 12px 15px;
                border: 2px solid #e1e5e9;
                border-radius: 8px;
                font-size: 14px;
                transition: all 0.3s ease;
                background: #f8f9fa;
                box-sizing: border-box;
            }

            .form-group input:focus,
            .form-group textarea:focus {
                outline: none;
                border-color: #667eea;
                background: white;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .form-group textarea {
                min-height: 80px;
                resize: vertical;
            }

            .form-group label {
                position: absolute;
                left: 15px;
                top: 12px;
                font-size: 14px;
                color: #6c757d;
                transition: all 0.3s ease;
                pointer-events: none;
                background: transparent;
                padding: 0 5px;
            }

            .form-group input:focus+label,
            .form-group textarea:focus+label,
            .form-group input:not(:placeholder-shown)+label,
            .form-group textarea:not(:placeholder-shown)+label {
                top: -8px;
                left: 10px;
                font-size: 12px;
                color: #667eea;
                background: white;
            }

            /* File Upload */
            .file-upload {
                position: relative;
                display: inline-block;
                cursor: pointer;
                width: 100%;
            }

            .file-upload input[type="file"] {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .file-upload-label {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 15px;
                border: 2px dashed #e1e5e9;
                border-radius: 8px;
                background: #f8f9fa;
                color: #6c757d;
                font-size: 14px;
                transition: all 0.3s ease;
            }

            .file-upload:hover .file-upload-label {
                border-color: #667eea;
                background: rgba(102, 126, 234, 0.05);
                color: #667eea;
            }

            /* Submit Button */
            .submit-btn {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .submit-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            }

            .submit-btn:active {
                transform: translateY(0);
            }

            /* Success Message */
            .success-message {
                background: #d4edda;
                color: #155724;
                padding: 12px 15px;
                border-radius: 8px;
                border: 1px solid #c3e6cb;
                font-size: 14px;
                text-align: center;
                display: none;
            }

            /* Close functionality - hide the form when closed */
            .chat-window.closed {
                display: none;
            }

            /* Mobile Responsiveness */
            @media (max-width: 768px) {
                .chat-window {
                    width: 95%;
                    max-width: none;
                    min-width: 280px;
                    max-height: 85vh;
                    top: 50%;
                }

                .chat-header {
                    padding: 15px;
                }

                .chat-header h3 {
                    font-size: 16px;
                }

                .chat-body {
                    padding: 15px;
                    max-height: calc(85vh - 80px);
                }

                .form-group input,
                .form-group textarea {
                    padding: 10px 12px;
                    font-size: 16px;
                    /* Prevents zoom on iOS */
                }

                .form-group label {
                    left: 12px;
                    top: 10px;
                }

                .form-group input:focus+label,
                .form-group textarea:focus+label,
                .form-group input:not(:placeholder-shown)+label,
                .form-group textarea:not(:placeholder-shown)+label {
                    left: 8px;
                }

            }

            @media (max-width: 480px) {
                .chat-window {
                    width: 98%;
                    margin: 0 1%;
                    max-height: 90vh;
                    top: 50%;
                }

                .chat-body {
                    padding: 12px;
                    max-height: calc(90vh - 70px);
                }

                .support-form {
                    gap: 12px;
                }
            }

            /* Very small screens */
            @media (max-width: 320px) {
                .chat-window {
                    min-width: 280px;
                    top: 40%;
                }

                .chat-header {
                    padding: 12px;
                }

                .chat-body {
                    padding: 10px;
                }
            }

            /* Landscape orientation on mobile */
            @media (max-height: 600px) and (orientation: landscape) {
                .chat-window {
                    max-height: 95vh;
                    top: 60%;
                }

                .chat-body {
                    max-height: calc(95vh - 70px);
                }
            }

            /* Loading Animation */
            .loading {
                opacity: 0.7;
                pointer-events: none;
            }

            .loading .submit-btn {
                background: #6c757d;
            }

            .loading .submit-btn::after {
                content: '';
                position: absolute;
                width: 16px;
                height: 16px;
                border: 2px solid transparent;
                border-top: 2px solid white;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                top: 35%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            @keyframes spin {
                to {
                    transform: translate(-50%, -50%) rotate(360deg);
                }
            }
        </style>

        <!-- Support Form - Always Open -->
        <div class="chat-window" id="chatWindow">
            <!-- Chat Header -->
            <div class="chat-header">
                <h4>How can we help?</h4>
            </div>

            <!-- Chat Body -->
            <div class="chat-body">
                <!-- Success Message -->
                <div class="success-message" id="successMessage">
                    Thank you! Your message has been sent successfully. We'll get back to you soon.
                </div>

                <!-- Support Form -->
                <form class="support-form" id="supportForm" action="{{ route('zendesk.submit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder=" " required value="{{ auth()->user()->name }}">
                        <label>Your Name</label>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" placeholder=" " required value="{{ auth()->user()->email }}">
                        <label>Email Address</label>
                    </div>

                    <div class="form-group">
                        <input type="text" name="subject" placeholder=" " required>
                        <label>Subject</label>
                    </div>

                    <div class="form-group">
                        <textarea name="message" placeholder=" " required></textarea>
                        <label>Describe your issue</label>
                    </div>

                    <div class="file-upload">
                        <input type="file" name="attachment" id="fileInput">
                        <div class="file-upload-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                            <span id="fileLabel">Attach a file (optional)</span>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const chatWindow = document.getElementById('chatWindow');
                const closeBtn = document.getElementById('closeBtn');
                const fileInput = document.getElementById('fileInput');
                const fileLabel = document.getElementById('fileLabel');

                // Close chat window - only hide it
                if (closeBtn && chatWindow) {
                    closeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        chatWindow.classList.add('closed');
                    });
                }

                // File input change handler
                if (fileInput && fileLabel) {
                    fileInput.addEventListener('change', function() {
                        if (this.files && this.files.length > 0) {
                            fileLabel.textContent = this.files[0].name;
                        } else {
                            fileLabel.textContent = 'Attach a file (optional)';
                        }
                    });
                }
            });
        </script>

    </x-app-layout>
@endsection
