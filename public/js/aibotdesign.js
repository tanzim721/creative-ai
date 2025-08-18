{
    'use strict';
    let structure = {
        'menu': [
            {
                'title': 'Projects',
                'id': 'projects',
                'submenu': [
                    {
                        'title': 'Project 1',
                        'id': 'p1'
                    },
                    {
                        'title': 'Project 2',
                        'id': 'p2'
                    },
                    {
                        'title': 'Project 3',
                        'id': 'p3'
                    }
                ]
            },
            {
                'title': 'Writing',
                'id': 'writing',
                'submenu': [
                    {
                        'title': 'Articles',
                        'id': 'articles'
                    },
                    {
                        'title': 'Theses',
                        'id': 'theses'
                    }
                ]
            },
            {
                'title': 'Contact',
                'id': 'contact',
                'submenu': [
                    {
                        'title': 'Social media',
                        'id': 'socialmedia'
                    },
                    {
                        'title': 'Email',
                        'id': 'email'
                    },
                    {
                        'title': 'Address',
                        'id': 'address'
                    }
                ]
            }
        ]
    },
        idle,
        idletime = 4500000;
    const chat = document.querySelector('.chat');
    const content = document.querySelector('.content');




    /// This is the main message generator. Also generates button 
    const newMessage = (message, type = 'user') => {
        let bubble = document.createElement('li'),
            slideIn = (el, i) => {
                setTimeout(() => {
                    el.classList.add('show');
                }, i * 150 ? i * 150 : 10);
            },
            scroll,
            scrollDown = () => {
                chat.scrollTop += Math.floor(bubble.offsetHeight / 18);
            };

        let botpicbubble = document.createElement('div')

        bubble.classList.add('message');
        bubble.classList.add(type);
        bubble.innerHTML = type === 'user' ? `<nav style="margin-top:3vh;">${message}</nav>` : `<p>${message}</p>`;

        chat.appendChild(botpicbubble);
        chat.appendChild(bubble);


        //console.log(chat);

        scroll = window.setInterval(scrollDown, 16);
        setTimeout(() => {
            window.clearInterval(scroll);
            chat.scrollTop = chat.scrollHeight;
        }, 300);

        setTimeout(() => {
            bubble.classList.add('show');
        }, 10);

        if (type === 'user') {
            let animate = chat.querySelectorAll('button:not(:disabled)');
            for (let i = 0; i < animate.length; i += 1) {
                slideIn(animate[i], i);
            }
            bubble.classList.add('active');
        }
        else {
            bubble.classList.add('botpic');
        }

        console.log(botpicbubble)
    };

    ////




    const randomReply = replies => replies[Math.floor(Math.random() * replies.length)];

    const checkUp = () => {
        let lastMessage = document.querySelector('.active'),
            idleReplies = [
                'Did you fall asleep? &#x1F634;',
                'Coffee break? &#x2615;',
                'Still there?',
                '&#x2744; &#x1F331; &#x1F31E; &#x1F342;'
            ];
        if (lastMessage) {
            lastMessage.parentNode.removeChild(lastMessage);
        }
        //newMessage(randomReply(idleReplies), 'bot');
        setTimeout(() => {
            let helpReplies = [
                'Don\'t like this conversation? Send an email to <a href="mailto:mike@redvolume.com">mike@redvolume.com</a> if you want a real one. &#x1F680;',
                'Not finding what you\'re looking for? Send an email to <a href="mailto:mike@redvolume.com">mike@redvolume.com</a> with any questions...',
                'Wanna talk to a real person? &#x1F4AC; Fire off an email to <a href="mailto:mike@redvolume.com">mike@redvolume.com</a>. &#x1F525;'
            ];
            //newMessage(randomReply(helpReplies), 'bot');
            setTimeout(() => {
                let knowMoreReplies = [
                    'Where\'s the normal web page? &#x1F61E;',
                    'I want a regular web page &#x1F631;',
                    'Do you have a regular website? &#x1F63B;'
                ],
                    ageRange10_20 = ['10-20'],
                    ageRange21_35 = ['21-35'],
                    ageRange36_55 = ['36-55'],
                    menuAgainReplies = [
                        'Show me the options again please &#x2705;',
                        'Ok, go! &#x1F697;',
                        'I wanna check something &#x1F44D;'
                    ];
                //newMessage(`<button class="choice newmenu showinfo">${ageRange10_20}</button><br /><button class="choice newmenu showmenu">${ageRange21_35}</button>
                //<br /><button class="choice newmenu showmenu">${ageRange36_55}</button>`);
            }, 300);
        }, 500);
    };


    //chat.addEventListener('click', function (event) {
    //    if (event.target.classList.contains('choice')) {
    //        const selectedGender = event.target.textContent;
    //        console.log('You selected:', selectedGender);
    //        // Optionally, display the selected choice in the chat
    //        newMessage(`You selected: ${selectedGender}`, 'bot');
    //        newMessage(`I selected: ${selectedGender}`, 'user');
    //    }
    //});


    const init = () => {
        let welcomeReplies = [
            'Hello I am Toucan Ai Bot ! Nice to meet you.',
            'I will be your guide to broadcast your message about your campaign'
        ];
        idle = window.setInterval(() => {
            window.clearInterval(idle);
            checkUp();
        }, idletime);



        // newMessage(`<button class="startButton newmenu showinfo">Start</button>`);
        newMessage(`<button class="creativeButton newmenu showinfo">Start</button>`);


        let interestTopic = ['Create Campaign', 'Create Template', 'Check Campaign Status', 'WhatsApp Instant Broadcast'];

        let whatsAppInitialOption = ['Create Template', 'Schedule Broadcast'];

        let telegramInitialOption = ['Create Campaign','Broadcast'];

        let approvalBool = ['Yes' , 'No'];

        let whatsAppTemplateChooseOption = ['Header , Body and Footer all text', 'Header Image , body , footer text'];
        
        let campaignType = ['WhatsApp' , 'Telegram']

        let timeofUser = ['1 min', '5 min', '10 min'];

        let questionAnswer = ['5', '10', '15'];

        //newMessage(conversation[0], 'bot');

        //newMessage(`<button class="choicemenu newmenu showinfo">${gender[0]}</button><button class="choicemenu newmenu showmenu">${gender[1]}</button>
        //<button class="choicemenu newmenu showmenu">${gender[2]}</button>`);
        //newMessage(`How can I assist you today ?  `, 'bot');
        function generateGUID(length) {
            let characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        function BasicTemplateForm() {
            newMessage(`<div class="mb-3 textarea-group">
                                <label for="headerTextarea" class="form-label">Template Name</label>
                                <input type="text" class="form-control me-2" cols="120" id="templateName" placeholder="Enter your template name here" required></input>
                                <br>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="headerTextarea" class="form-label">Header</label>
                                <textarea class="form-control" id="headerTextarea" rows="3" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateHeader">
                                    ✨ AI Generate Header
                                </button>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="bodyTextarea" class="form-label">Body</label>
                                <textarea class="form-control" id="bodyTextarea" rows="6" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateBody">
                                    ✨ AI Generate Body 
                                </button>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="footerTextarea" class="form-label">Footer</label>
                                <textarea class="form-control" id="footerTextarea" rows="3" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateFooter">
                                    ✨ AI Generate Footer
                                </button>
                            </div>
                            <button type="submit" class="btn btn-success sumbitBasicTemplate">Submit</button>`);

            document.getElementById('headerTextarea').value = sessionStorage.getItem('headerTextarea');
            document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
            document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
        }


        function ImageTemplateForm() {
            newMessage(`<div class="mb-3 textarea-group">
                                <label for="headerImage" class="form-label">Header Image</label>
                                <input type="file" class="form-control" id="headerImage" accept="image/*" required>
                                <br>
                                <img id="headerImagePreview" src="" alt="Header Image Preview" style="display: none; max-width: 100%; height: auto; margin-top: 10px;">
                                <br>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="bodyTextarea" class="form-label">Body</label>
                                <textarea class="form-control" id="bodyTextarea" rows="6" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateBodyImage">
                                    ✨ AI Generate Body 
                                </button>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="footerTextarea" class="form-label">Footer</label>
                                <textarea class="form-control" id="footerTextarea" rows="3" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateFooterImage">
                                    ✨ AI Generate Footer
                                </button>
                            </div>
                            <button type="submit" class="btn btn-success sumbitBasicTemplateImage">Submit</button>`);

            document.getElementById('headerTextarea').value = sessionStorage.getItem('headerTextarea');
            document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
            document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
        }


        function ImageTemplateFormTelegram() {
            newMessage(`<div class="mb-3 textarea-group">
                                <label for="headerImage" class="form-label">Header Image</label>
                                <input type="file" class="form-control" id="headerImage" accept="image/*" required>
                                <br>
                                <img id="headerImagePreview" src="" alt="Header Image Preview" style="display: none; max-width: 100%; height: auto; margin-top: 10px;">
                                <br>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="bodyTextarea" class="form-label">Body</label>
                                <textarea class="form-control" id="bodyTextarea" rows="6" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateBodyImage">
                                    ✨ AI Generate Body 
                                </button>
                            </div>
                            <button type="button" class="btn btn-secondary" id="add-mini-app">+ Add Website</button>
                            <button type="button" class="btn btn-danger" id="remove-mini-app">- Remove Website</button>
                            <button type="submit" class="btn btn-success sumbitBasicTemplateImage">Submit</button>`);

            document.getElementById('headerTextarea').value = sessionStorage.getItem('headerTextarea');
            document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
            document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
        }

        function ImageTemplateFormUserUpload() {
            newMessage(`<div class="mb-3 textarea-group">
                                <label for="headerImage" class="form-label">Header Image</label>
                                <input type="file" class="form-control" id="headerImage" accept="image/*" required>
                                <br>
                                <img id="headerImagePreview" src="" alt="Header Image Preview" style="display: none; max-width: 100%; height: auto; margin-top: 10px;">
                                <br>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="bodyTextarea" class="form-label">Body</label>
                                <textarea class="form-control" id="bodyTextarea" rows="6" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateBodyImage">
                                    ✨ AI Generate Body 
                                </button>
                            </div>
                            <div class="mb-3 textarea-group">
                                <label for="footerTextarea" class="form-label">Footer</label>
                                <textarea class="form-control" id="footerTextarea" rows="3" cols="120"></textarea>
                                <br>
                                <button type="button" class="newmenu showinfo aiGenerateFooterImage">
                                    ✨ AI Generate Footer
                                </button>
                            </div>
                            <button type="submit" class="btn btn-success sumbitBasicTemplate">Submit</button>`);

            document.getElementById('headerTextarea').value = sessionStorage.getItem('headerTextarea');
            document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
            document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
        }

        function SetSchedule() {
            newMessage('Please confirm your date','bot');
            newMessage(`<input type="datetime-local" class="form-control" id="datetimeBasic" />
            <p></p>
            <button class="btn btn-primary dateConfirmation" id="dateConfirmation">Confirm</button>`); 
        }

        function SetScheduleImageTemplate() {
            newMessage('Please confirm your date', 'bot');
            newMessage(`<input type="datetime-local" class="form-control" id="datetimeBasic" />
            <p></p>
            <button class="btn btn-primary dateConfirmationImage" id="dateConfirmationImage">Confirm</button>`);
        }
        

        chat.addEventListener('click', function (event) {

            console.log('Clicked');

            if (event.target.classList.contains('choiceinterest')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');

                if (selectedTopic == '📢 ' +interestTopic[0]) {
                    newMessage(`<button class="choiceTemplateTypeWhatsApp newmenu showinfo">
                            <i class="fab fa-whatsapp"></i> ${campaignType[0]}
                        </button>
                        <button class="choiceTemplateTypeTelegram newmenu showmenu">
                            <i class="fab fa-telegram-plane"></i> ${campaignType[1]}
                        </button>
                        `);
                }

                if (selectedTopic == '📰 ' + interestTopic[1]) {
                    newMessage('After creating template please click done ', 'bot');
                    newMessage(`<iframe src="../home/TemplateCreationInSideBot" title="Telegram Page" style="
                                width: 90vw;
                                height: 70vh;
                            "></iframe>`);
                    newMessage(`<button class="startButton newmenu showinfo">Done</button>`);
                }


                if (selectedTopic == '🧭 ' + interestTopic[2]) {
                    newMessage(`Check your campaign status`,'bot');
                    newMessage(`<canvas id="campaignPieChart" width="400" height="400"></canvas>`);

                    fetch('../Home/GetCampaignStats')
                        .then(response => response.json())
                        .then(data => {
                            const ctx = document.getElementById('campaignPieChart').getContext('2d');
                            const campaignPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Image Campaign Count', 'Basic Campaign Count', 'Completed Image Campaign', 'Completed Basic Campaign'],
                                    datasets: [{
                                        label: 'Campaign Stats',
                                        data: [data.imageCampaignCount, data.basicCampaignCount, data.completedImageCampaign, data.completedBasicCampaign],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: true,
                                            text: 'Campaign Statistics'
                                        }
                                    }
                                }
                            });
                        })
                        .catch(error => console.error('Error fetching data:', error));

                    newMessage(`<button class="startButton newmenu showinfo">Start</button>`);
                }

            }

            if (event.target.classList.contains('choiceTemplateTypeWhatsApp')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`<button class="whatsAppCampaignCreateCampaign newmenu showinfo">${whatsAppInitialOption[0]}</button>
                <button class="whatsAppCampaignScheduleBroadCast newmenu showmenu"> ${whatsAppInitialOption[1]}</button>`);

            }

            //// Telegram
            if (event.target.classList.contains('choiceTemplateTypeTelegram')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`<button class="telegramCampaignCreateCampaign newmenu showinfo">${telegramInitialOption[0]}</button>
                <button class="telegramCampaignScheduleBroadCast newmenu showmenu"> ${telegramInitialOption[1]}</button>`);
                //newMessage(`<iframe src="../home/telegram" title="Telegram Page" style="
                //                width: 90vw;
                //                height: 70vh;
                //            "></iframe>`);

            }

            ////
            if (event.target.classList.contains('telegramCampaignCreateCampaign')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`For custom Ai Generated Image go to Ai Message Generate then navigate to the second tab`, 'bot');
                newMessage(`Please tell me about your campaign details, I also need to know if you have any promo or offer`, 'bot');
                newMessage(`<div class="form-group">
                                <textarea class="form-control" id="campaignDetails" rows="6" cols="120"></textarea>
                            </div>
                            <button type="submit" class="campaignDetailSubmitTelegram btn btn-primary">Submit</button>`);
                //newMessage(`<iframe src="../home/TelegramCampaignPage" title="Telegram Page" style="
                //                width: 90vw;
                //                height: 70vh;
                //            "></iframe>`);

            }

            if (event.target.classList.contains('campaignDetailSubmitTelegram')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const campaignDetail = document.getElementById('campaignDetails').value;
                const questionType = event.target.textContent;
                //const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignDetails', campaignDetail);
                //console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage('Thanks ...', 'bot');
                newMessage('Please fill up this form to create campaign ', 'bot');
                newMessage('After campaign setup please click done ', 'bot');
                newMessage(`<iframe src="../home/TelegramCampaignPage" title="Telegram Page" style="
                                width: 90vw;
                                height: 70vh;
                            "></iframe>`);
                newMessage(`<button class="startButton newmenu showinfo">Done</button>`);

            }



            ////
            if (event.target.classList.contains('telegramCampaignScheduleBroadCast')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`<iframe src="../home/telegram" title="Telegram Page" style="
                                width: 90vw;
                                height: 70vh;
                            "></iframe>`);

            }


            ////

            if (event.target.classList.contains('whatsAppCampaignCreateCampaign')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`Please choose option what type of template you want to create`, 'bot');
                newMessage(`<button class="whatsAppTemplateChooseOption1 newmenu showinfo">${whatsAppTemplateChooseOption[0]}</button>
                <button class="whatsAppTemplateChooseOption2 newmenu showmenu"> ${whatsAppTemplateChooseOption[1]}</button>`);

            }


            if (event.target.classList.contains('whatsAppTemplateChooseOption1')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`Please tell me about your campaign details, I also need to know if you have any promo or offer`, 'bot');
                newMessage(`<div class="form-group">
                                <textarea class="form-control" id="campaignDetails" rows="6" cols="120"></textarea>
                            </div>
                            <button type="submit" class="campaignDetailSubmit btn btn-primary">Submit</button>`);

            }

            if (event.target.classList.contains('whatsAppTemplateChooseOption2')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const questionType = event.target.textContent;
                const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignType', selectedTopic);
                console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`Please tell me about your campaign details, I also need to know if you have any promo or offer`, 'bot');
                newMessage(`<div class="form-group">
                                <textarea class="form-control" id="campaignDetails" rows="6" cols="120"></textarea>
                            </div>
                            <button type="submit" class="campaignDetailSubmitImageTemplate btn btn-primary">Submit</button>`);

                //newMessage(`For custom Ai Generated Image go to Ai Message Generate then navigate to the second tab`, 'bot');
                //ImageTemplateFormUserUpload();

            }

            if (event.target.classList.contains('campaignDetailSubmitImageTemplate')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const campaignDetail = document.getElementById('campaignDetails').value;
                const questionType = event.target.textContent;
                //const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignDetails', campaignDetail);
                //console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage(`You selected: ${questionType}`, 'bot');
                newMessage(`For custom Ai Generated Image go to Ai Message Generate then navigate to the second tab`, 'bot');
                ImageTemplateForm();

            }


            if (event.target.classList.contains('campaignDetailSubmit')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const campaignDetail = document.getElementById('campaignDetails').value;
                const questionType = event.target.textContent;
                //const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignDetails', campaignDetail);
                //console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage('Thanks ...', 'bot');
                newMessage('Please fill up this form to create campaign ', 'bot');
                BasicTemplateForm();

            }


            /// Second template , image with message
            if (event.target.classList.contains('campaignDetailSubmit2')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                const campaignDetail = document.getElementById('campaignDetails').value;
                const questionType = event.target.textContent;
                //const selectedTopic = event.target.textContent;
                sessionStorage.setItem('campaignDetails', campaignDetail);
                //console.log('You selected:', questionType);
                // Optionally, display the selected choice in the chat
                newMessage('Thanks ...', 'bot');
                newMessage('Please fill up this form to create campaign ', 'bot');
                ImageTemplateForm();

            }


            ////// Generate header text

            if (event.target.classList.contains('aiGenerateHeader')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                var settings = {
                    "url": "../chatgpt/MarketingScriptBody?text=" + sessionStorage.getItem('campaignDetails') + "&component=header",
                    "method": "GET",
                    "timeout": 0,
                };

                
               

                $.ajax(settings).done(function (response) {
                    document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
                    document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
                    sessionStorage.setItem('headerTextarea', response);
                    document.getElementById('headerTextarea').value = sessionStorage.getItem('headerTextarea');
                   
                });

                BasicTemplateForm();


            }

            ///


            ////// Generate body text
            if (event.target.classList.contains('aiGenerateBody')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                var settings = {
                    "url": "../chatgpt/MarketingScriptBody?text=" + sessionStorage.getItem('campaignDetails') + "&component=body",
                    "method": "GET",
                    "timeout": 0,
                };
                
                $.ajax(settings).done(function (response) {
                    document.getElementById('headerTextarea').value = sessionStorage.getItem('headerTextarea');
                    document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
                    sessionStorage.setItem('bodyTextarea', response);
                    document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
                });

                BasicTemplateForm();


            }


            /////
            /// Generate body text image template
            ////// Generate body text
            if (event.target.classList.contains('aiGenerateBodyImage')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                var settings = {
                    "url": "../chatgpt/MarketingScriptBody?text=" + sessionStorage.getItem('campaignDetails') + "&component=body",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function (response) {
                    document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
                    sessionStorage.setItem('bodyTextarea', response);
                    document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
                });

                ImageTemplateForm();


            }


            /////

            //// Generate footer text image template

            if (event.target.classList.contains('aiGenerateFooterImage')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                var settings = {
                    "url": "../chatgpt/MarketingScriptBody?text=" + sessionStorage.getItem('campaignDetails') + "&component=footer",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function (response) {
                    document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
                    sessionStorage.setItem('footerTextarea', response);
                    document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
                });

                ImageTemplateForm();


            }


            //// Ai generate footer

            if (event.target.classList.contains('aiGenerateFooter')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                var settings = {
                    "url": "../chatgpt/MarketingScriptBody?text=" + sessionStorage.getItem('campaignDetails') + "&component=footer",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function (response) {
                    document.getElementById('headerTextarea').value = sessionStorage.getItem('headerTextarea');
                    document.getElementById('bodyTextarea').value = sessionStorage.getItem('bodyTextarea');
                    sessionStorage.setItem('footerTextarea', response);
                    document.getElementById('footerTextarea').value = sessionStorage.getItem('footerTextarea');
                });

                BasicTemplateForm();


            }

            /////

            ////  Submit basic template

            if (event.target.classList.contains('sumbitBasicTemplate')) {
                const templateName = document.getElementById('templateName').value;
                console.log(templateName);
                sessionStorage.setItem('templateName', document.getElementById('templateName').value)
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                if (sessionStorage.getItem('headerTextarea') != null && sessionStorage.getItem('bodyTextarea') != null && sessionStorage.getItem('footerTextarea') != null
                    && templateName != '') {
                    newMessage(`Shall I send to meta for approval ?`, 'bot');
                    newMessage(`<button class="approvalTrue newmenu showinfo">${approvalBool[0]}</button>
                <button class="approvalTrueapprovalFalse newmenu showmenu"> ${approvalBool[1]}</button>`);
                    //BasicTemplateForm();
                }
                else {
                    newMessage(`Please complete all the form including template name `, 'bot');
                    BasicTemplateForm();
                    
                }
                
            }

            ///Image template
            if (event.target.classList.contains('sumbitBasicTemplateImage')) {
                //const templateName = document.getElementById('templateName').value;
                //console.log(templateName);
                //sessionStorage.setItem('templateName', document.getElementById('templateName').value)
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                //newMessage(`Shall I save image template ? `, 'bot');
                const randomNumber = Math.random().toString(36).substr(2, 9);
                const file = $('#headerImage')[0].files[0];
                var imageLocation = 'https://ai.shabox.mobi/assets/';
                const fileName = `image-${randomNumber}.jpg`;
                imageLocation = imageLocation + fileName;
                if (!file) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Image Selected',
                        text: 'Please select an image to upload.',
                    });
                    return;
                }

                const formData = new FormData();
                //file.fileName = fileName;
                formData.append('file', file);
                formData.append('fileName', fileName);
                //formData.append('aitextBody', sessionStorage.getItem('bodyTextarea'));
                //debugger;
                $.ajax({
                    url: '../ImageUploader/UploadImageAiBot',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Uploading...',
                            text: 'Please wait while the image is being uploaded.',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function (response) {
                        var settings = {
                            "url": "../ImageUploader/InsertTemplate?imageLocation=" + response + "&message=" + sessionStorage.getItem('bodyTextarea'),
                            "method": "POST",
                            "timeout": 0,
                        };

                        $.ajax(settings).done(function (response) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Image uploaded and message saved successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                            sessionStorage.setItem('ImageTemplateName', response);
                            SetScheduleImageTemplate();
                        });

                        //var settings = {
                        //    "url": "../ImageUploader/InsertTemplate?imageLocation=" + imageLocation + "&message=" + document.getElementById('chatBody').textContent,
                        //    "method": "POST",
                        //    "timeout": 0,
                        //};

                        //$.ajax(settings).done(function (response) {
                        //    Swal.fire({
                        //        title: 'Success!',
                        //        text: 'Image uploaded and message saved successfully.',
                        //        icon: 'success',
                        //        confirmButtonText: 'OK'
                        //    });
                        //});
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: 'There was an error uploading your image. Please try again.',
                        });
                    }
                });


            }
            /////

            /////

            ///// Submit basic template to meta approval

            if (event.target.classList.contains('approvalTrue')) {
                console.log(sessionStorage.getItem('templateName'));
                document.addEventListener('click', e => {    // User createds
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                //SetSchedule();
                let existingString = sessionStorage.getItem('templateName');
                let newGUID = generateGUID(6);

                // Step 3: Concatenate the existing string with the new GUID
                let updatedString = existingString + newGUID;

                // Step 4: Store the updated string back in sessionStorage
                sessionStorage.setItem('templateName', updatedString);

                var settings = {
                    "url": "../whatsapp/CreateTemplate?header=" + sessionStorage.getItem('headerTextarea') + "&body=" + sessionStorage.getItem('bodyTextarea') + "&footer=" + sessionStorage.getItem('footerTextarea') + "&templateName=" + sessionStorage.getItem('templateName'),
                    "method": "GET",
                    "timeout": 0,
                    "headers": {
                        "Cookie": ".AspNetCore.Antiforgery.yNEviBeLOjo=CfDJ8K2spPx8JwlLrRNbN1oSH9kmof8t_GNBFEWN6_nWxvlNlFLeAdCdEAxpU-0P9vg3yv7c1QRJ3HcJtmrPvbjtO6zMQXCQRl-cfshgThzzIt3oo4ZACLqxvM9dEWf0Po8eI9kJpZtKTBCPdumz_Cy_hIY"
                    },
                };

                $.ajax(settings).done(function (response) {
                    if (response === "SUCCESS") {
                        // Show success alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Template Created',
                            text: 'Your template has been created successfully!',
                        });
                        newMessage(`Your template is sent to Meta for approval `, 'bot');
                        //newMessage(`<button class="startButton newmenu showinfo">Start</button>`);
                        SetSchedule();
                    } else {
                        // Show error alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response,
                        });
                        newMessage(`<button class="startButton newmenu showinfo">Start</button>`);
                    }
                });

            }


            //////// Set a campaign schedule

            if (event.target.classList.contains('dateConfirmation')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });


                var settings = {
                    "url": "../home/SetBasicCampaign?templateName=" + sessionStorage.getItem('templateName') + "&time=" + document.getElementById('datetimeBasic').value ,
                    "method": "GET",
                    "timeout": 0,
                    "headers": {
                        "Cookie": ".AspNetCore.Antiforgery.yNEviBeLOjo=CfDJ8K2spPx8JwlLrRNbN1oSH9kmof8t_GNBFEWN6_nWxvlNlFLeAdCdEAxpU-0P9vg3yv7c1QRJ3HcJtmrPvbjtO6zMQXCQRl-cfshgThzzIt3oo4ZACLqxvM9dEWf0Po8eI9kJpZtKTBCPdumz_Cy_hIY"
                    },
                };

                $.ajax(settings).done(function (response) {
                    newMessage(`Please check schedule, I have set a schedule broadcast for you`, 'bot');
                    newMessage(`<button class="startButton newmenu showinfo">Start</button>`);
                });
            }

            //// Image template date confirmation

            if (event.target.classList.contains('dateConfirmationImage')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });


                var settings = {
                    "url": "../home/SetImageCampaign?templateName=" + sessionStorage.getItem('ImageTemplateName') + "&time=" + document.getElementById('datetimeBasic').value,
                    "method": "GET",
                    "timeout": 0,
                    "headers": {
                        "Cookie": ".AspNetCore.Antiforgery.yNEviBeLOjo=CfDJ8K2spPx8JwlLrRNbN1oSH9kmof8t_GNBFEWN6_nWxvlNlFLeAdCdEAxpU-0P9vg3yv7c1QRJ3HcJtmrPvbjtO6zMQXCQRl-cfshgThzzIt3oo4ZACLqxvM9dEWf0Po8eI9kJpZtKTBCPdumz_Cy_hIY"
                    },
                };

                $.ajax(settings).done(function (response) {
                    newMessage(`Please check schedule, I have set a schedule broadcast for you`, 'bot');
                    newMessage(`<button class="startButton newmenu showinfo">Start</button>`);
                });
            }


            /////

            if (event.target.classList.contains('startButton')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                newMessage(welcomeReplies[0], 'bot');
                newMessage(welcomeReplies[1], 'bot');
                newMessage(`<button class="choiceinterest newmenu showinfo">📢 ${interestTopic[0]}</button>
                <button class="choiceinterest newmenu showmenu">📰 ${interestTopic[1]}</button>
                <button class="choiceinterest newmenu showmenu">🧭 ${interestTopic[2]}</button>
                <button class="choiceinterest newmenu showmenu">🤖 ${interestTopic[3]}</button>`);
            }

            if (event.target.classList.contains('creativeButton')) {
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                newMessage(`<button class="choiceinterest newmenu showinfo">Create Campaign</button>`, 'bot');
            }


            if (event.target.classList.contains('choicemenu')) {
                const selectedGender = event.target.textContent;
                //console.log('You selected:', selectedGender);
                // Optionally, display the selected choice in the chat
                //newMessage(`${selectedGender}`, 'bot');
                //document.addEventListener('click', e => {
                //    console.log(e.target);
                //    makeUserBubble(e.target);
                //});
                //makeUserBubble(`You selected`);
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });

                let age = ['10-20', '21-35', '36-55'];

                newMessage(`Please tell me your age`, 'bot');

                newMessage(`<button class="choiceage newmenu showinfo">${age[0]}</button><button class="choiceage newmenu showmenu">${age[1]}</button>
            <button class="choiceage newmenu showmenu">${age[2]}</button>`);

            }

            if (event.target.classList.contains('choiceage')) {
                const selectedAge = event.target.textContent;
                console.log('You selected:', selectedAge);
                // Optionally, display the selected choice in the chat
                //newMessage(`You selected: ${selectedAge}`, 'bot');
                document.addEventListener('click', e => {    // User created
                    if (e.target.tagName == 'BUTTON') {
                        makeUserBubble(e.target);
                    }
                });
                newMessage(`Great! Can you select your topic of interest ? `, 'bot');

                newMessage(`<button class="choiceinterest newmenu showinfo">${interestTopic[0]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[1]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[2]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[3]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[4]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[5]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[6]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[7]}</button>
            <span> </span><button class="choiceinterest newmenu showmenu">${interestTopic[8]}</button>`);

            }

            //if (event.target.classList.contains('choiceinterest')) {
            //    const selectedTopic = event.target.textContent;
            //    console.log('You selected:', selectedTopic);
            //    // Optionally, display the selected choice in the chat
            //    newMessage(`You selected: ${selectedTopic}`, 'bot');

            //    sessionStorage.setItem('aitopic', selectedTopic);

            //    document.addEventListener('click', e => {    // User created
            //        if (e.target.tagName == 'BUTTON') {
            //            makeUserBubble(e.target);
            //        }
            //    });

            //    newMessage(`Awesome Please Answer 2 more question `, 'bot');

            //    newMessage(`How much time do you have today  ? `, 'bot');

            //    newMessage(`<button class="choiceUsertime newmenu showinfo">${timeofUser[0]}</button>
            //<button class="choiceUsertime newmenu showmenu">${timeofUser[1]}</button>
            //<button class="choiceUsertime newmenu showmenu">${timeofUser[2]}</button>`);


            //}


            //if (event.target.classList.contains('choiceinterest')) {
            //    const selectedTopic = event.target.textContent;
            //    console.log('You selected:', selectedTopic);
            //    // Optionally, display the selected choice in the chat
            //    //newMessage(`You selected: ${userTime}`, 'bot');
            //    sessionStorage.setItem('aitopic', selectedTopic);

            //    document.addEventListener('click', e => {    // User created
            //        if (e.target.tagName == 'BUTTON') {
            //            makeUserBubble(e.target);
            //        }
            //    });

            //    newMessage(`How many question you want to answer  ? `, 'bot');

            ////    newMessage(`<button class="choicequestiontype newmenu showinfo">${questionAnswer[0]}</button>
            ////<button class="choicequestiontype newmenu showmenu">${questionAnswer[1]}</button>
            ////<button class="choicequestiontype newmenu showmenu">${questionAnswer[2]}</button>`);

            //}

            
            else {
                console.log('Remain Idle')
            }

        });

    };










    const makeUserBubble = el => {
        el.parentNode.parentNode.classList.add('selected');
        el.parentNode.parentNode.classList.remove('active');
        el.parentNode.parentNode.innerHTML = `<p>${el.textContent}</p>`;
    };




    const showMenu = again => {
        let menu = '',
            goBack = chat.querySelector('button.newmenu'),
            againReplies = [
                'Here\'s a few things that I can tell you about... &#x1F3A4;',
                'Ok, check this out! &#x1F447;',
                'Anything else you\'re interested in? &#x1F64F;'
            ],
            replies = [
                'What would you like to know more about? &#x1F4A1;',
                'Can I interest you in any of this? &#x1F4AF;',
                'Select something of the following... &#x1F447;'
            ];
        if (goBack) {
            makeUserBubble(goBack);
        }
        setTimeout(() => {
            again ? newMessage(randomReply(againReplies), 'bot') : newMessage(randomReply(replies), 'bot');
            structure.menu.forEach((val, index) => {
                menu += `<button class="choice menu" data-submenu="${index}">${val.title}</button>`;
            });
            setTimeout(() => {
                newMessage(menu);
            }, 300);
        }, 500);
        idle = window.setInterval(() => {
            window.clearInterval(idle);
            checkUp();
        }, idletime);
    };





    const menuClick = clicked => {
        let submenu = '',
            menuChoice = structure.menu[clicked.getAttribute('data-submenu')],
            replies = [
                '&#x1F44D; Here\'s what I have on that...',
                'See anything interesting? &#x1F648;',
                'Any of this cool?'
            ],
            userReplies = [
                `I wanna read about something other than ${menuChoice.title.toLowerCase()} &#x1F61C;`,
                'Show me the menu again &#x1F60B;',
                `${menuChoice.title} was interesting, but show me something else... &#x1F612;`
            ];
        menuChoice.submenu.forEach(val => {
            let id = `${menuChoice.id}-${val.id}`;
            submenu += `<button class="choice submenu" aria-controls="${id}" data-content="${id}">${val.title}</button>`;
        });
        submenu += `<br /><button class="choice submenu newmenu">${randomReply(userReplies)}</button>`;
        setTimeout(() => {
            newMessage(randomReply(replies), 'bot');
            setTimeout(() => {
                newMessage(submenu);
            }, 300);
        }, 500);
    };




    const toggleContent = article => {
        let buttons = chat.querySelectorAll('button');
        if (article) {
            article.classList.add('show');
            chat.setAttribute('aria-hidden', 'true');
            content.setAttribute('aria-hidden', 'false');
            content.tabIndex = '0';
            content.focus();
        } else {
            content.setAttribute('aria-hidden', 'true');
            content.tabIndex = '-1';
            chat.setAttribute('aria-hidden', 'false');
            if (history.state && history.state.id === 'content') {
                history.back();
            }
            setTimeout(() => {
                let active = document.querySelector('.content article.show');
                if (active) {
                    active.classList.remove('show');
                    chat.querySelector(`button[data-content="${active.id}"]`).focus();
                }
            }, 300);
        }
        for (let i = 0; i < buttons.length; i += 1) {
            buttons[i].tabIndex = article ? '-1' : '0';
        }
    };




    //// sub menu click
    const subMenuClick = clicked => {
        if (clicked.classList.contains('newmenu')) {
            showMenu(true);
        } else {
            toggleContent(document.getElementById(clicked.getAttribute('data-content')));
            history.pushState({ 'id': clicked.getAttribute('data-content') }, '', `#${clicked.getAttribute('data-content')}`);
        }
    };


    /////


    document.addEventListener('click', e => {
        console.log('Came here');
        //if (e.target.classList.contains('choice')) {
        //    window.clearInterval(idle);
        //    if (!e.target.classList.contains('submenu')) {
        //        makeUserBubble(e.target);
        //    }

        //    if (e.target.classList.contains('menu')) {
        //        menuClick(e.target);
        //    }

        //    if (e.target.classList.contains('submenu')) {
        //        subMenuClick(e.target);
        //    }

        //    if (e.target.classList.contains('start')) {
        //        showMenu();
        //    }

        //    if (e.target.classList.contains('showmenu')) {
        //        showMenu(true);
        //    }

        //    if (e.target.classList.contains('click')) {
        //        newMessage(`You selected: ${selectedGender}`, 'bot');
        //    }




        //    if (e.target.classList.contains('showinfo')) {
        //        console.log('came here');
        //        console.log(e.target.classList);
        //        let infoReplies = [
        //            'Here\'s my website ',
        //            'Here you go: ',
        //            'Check this one out '
        //        ],
        //            okReplies = [
        //                'OK &#x1F60E;',
        //                'How do I get back? &#x1F312;',
        //                'Ok, thanks! &#x1F44C;'
        //            ];
        //        setTimeout(() => {
        //            newMessage(`${randomReply(infoReplies)} <a target="_new" href="https://librarian.codes">https://librarian.codes</a>`, 'bot');
        //            setTimeout(() => {
        //                newMessage(`<button class="choice newmenu showmenu">${randomReply(okReplies)}</button>`);
        //            }, 300);
        //        }, 500);
        //    }
        //}
        //if (e.target.classList.contains('close')) {
        //    e.preventDefault();
        //    history.back();
        //}
    });













    setTimeout(() => {
        init();
    }, 500);

    if (document.getElementById(window.location.hash.split('#')[1])) {
        let contentId = window.location.hash.split('#')[1];
        history.replaceState('', '', '.');
        setTimeout(() => {
            toggleContent(document.getElementById(contentId));
            history.pushState({ 'id': contentId }, '', `#${contentId}`);
        }, 10);
    }
}
