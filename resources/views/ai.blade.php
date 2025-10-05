<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Gemini | Blingit Grocery</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" rel="stylesheet">
    
    <!-- Marked.js library for rendering Markdown -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f0fff4 0%, #fffde4 100%);
            min-height: 100vh;
        }
        
        /* Custom Blingit styles */
        .bling-shadow {
            box-shadow: 0 4px 24px 0 rgba(34,197,94,0.08), 0 1.5px 4px 0 rgba(251,191,36,0.12);
        }
        
        .bling-gradient {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
        }
        
        .bling-btn {
            background: linear-gradient(90deg, #faffd1 0%, #a1ffce 100%);
            color: #166534;
            font-weight: 600;
            border: none;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
        
        .bling-btn:hover {
            box-shadow: 0 4px 12px 0 rgba(34,197,94,0.2), 0 2px 6px 0 rgba(251,191,36,0.15);
            transform: translateY(-3px) scale(1.02);
        }
        
        /* Chat container styling */
        .chat-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(34, 197, 94, 0.1);
        }
        
        /* Custom scrollbar */
        .chat-window::-webkit-scrollbar { 
            width: 6px; 
        }
        
        .chat-window::-webkit-scrollbar-track { 
            background: #f1f5f9; 
            border-radius: 10px;
        }
        
        .chat-window::-webkit-scrollbar-thumb { 
            background: #cbd5e1; 
            border-radius: 10px; 
        }
        
        .chat-window::-webkit-scrollbar-thumb:hover { 
            background: #94a3b8; 
        }
        
        /* Message bubbles */
        .user-message {
            background: linear-gradient(135deg, #10B981, #34D399);
            color: white;
            border-radius: 20px 20px 6px 20px;
            max-width: 80%;
            margin-left: auto;
            animation: fadeIn 0.3s ease-out;
        }
        
        .bot-message {
            background: white;
            color: #374151;
            border-radius: 20px 20px 20px 6px;
            max-width: 80%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Suggestion chips */
        .suggestion-chip {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .suggestion-chip:hover {
            background: #F3F4F6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Input field */
        .message-input {
            border-radius: 20px;
            border: 1px solid #E5E7EB;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        
        .message-input:focus {
            outline: none;
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        
        /* Send button */
        .send-btn {
            background: linear-gradient(135deg, #10B981, #34D399);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        }
        
        .send-btn:disabled {
            background: #D1D5DB;
            transform: scale(1);
            box-shadow: none;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        /* Typing indicator */
        .typing-indicator {
            display: flex;
            padding: 12px 16px;
            background: #F3F4F6;
            border-radius: 20px;
            width: fit-content;
        }
        
        .typing-dot {
            width: 8px;
            height: 8px;
            background: #9CA3AF;
            border-radius: 50%;
            margin: 0 3px;
            animation: typingAnimation 1.4s infinite ease-in-out;
        }
        
        .typing-dot:nth-child(1) { animation-delay: 0s; }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes typingAnimation {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-5px); }
        }
        
        /* Markdown content styling */
        .prose h1, .prose h2, .prose h3 { 
            margin-bottom: 0.5em; 
            font-weight: 600; 
            color: #111827;
        }
        
        .prose p { 
            margin-bottom: 0.75em; 
            line-height: 1.6;
        }
        
        .prose ul, .prose ol { 
            margin-left: 1.5em; 
            margin-bottom: 0.75em; 
        }
        
        .prose a { 
            color: #1d4ed8; 
            text-decoration: underline; 
        }
        
        .prose code {
            background: #F3F4F6;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.875em;
        }
        
        .prose pre {
            background: #1F2937;
            color: #F9FAFB;
            padding: 12px;
            border-radius: 8px;
            overflow-x: auto;
            margin-bottom: 0.75em;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .chat-container {
                border-radius: 0;
                height: 100vh;
            }
            
            .user-message, .bot-message {
                max-width: 90%;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="chat-container w-full max-w-3xl h-[85vh] flex flex-col bling-shadow overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-white">
            <div class="flex items-center gap-3">
                <!-- Gemini Icon -->
                <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-tr from-green-400 to-blue-500 rounded-full text-white shadow-lg pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.848 3.113c-1.39-1.39-3.642-1.39-5.032 0l-1.782 1.782c-1.39 1.39-1.39 3.642 0 5.032l5.032 5.032c1.39 1.39 3.642 1.39 5.032 0l1.782-1.782c1.39-1.39 1.39-3.642 0-5.032L12.848 3.113zm-3.516 2.308l.526-.526c.642-.642 1.684-.642 2.326 0l.526.526l-3.378 3.378l-.526-.526c-.642-.642-.642-1.684 0-2.326l.526-.526zm-1.516 1.516l.526-.526c.642-.642 1.684-.642 2.326 0l.526.526l-3.378 3.378l-.526-.526c-.642-.642-.642-1.684 0-2.326l.526-.526zm6.91 1.13l-3.378 3.378l.526.526c.642.642 1.684-.642 2.326 0l.526-.526l-3.378-3.378l.526.526zm1.516 1.516l-3.378 3.378l.526.526c.642.642 1.684-.642 2.326 0l.526-.526l-3.378-3.378l.526.526zm-2.042 5.068l-.526.526c-.642.642-1.684.642-2.326 0l-.526-.526l3.378-3.378l.526.526c.642.642.642 1.684 0 2.326l-.526.526z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Blingit AI Assistant</h1>
                    <p class="text-xs text-green-600 font-semibold flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        Online & Ready to Help
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>

        <!-- Chat Window -->
        <div id="chatWindow" class="chat-window flex-1 overflow-y-auto p-5 space-y-4 bg-gray-50">
            <!-- Welcome Message -->
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center bg-white rounded-full text-sm shadow-sm">🤖</div>
                <div class="bot-message px-4 py-3 prose">
                    <p>Hi there! 👋 I'm your Blingit AI Assistant, here to help with:</p>
                    <ul>
                        <li>Recipe suggestions based on your ingredients</li>
                        <li>Nutritional information and healthy alternatives</li>
                        <li>Cooking tips and techniques</li>
                        <li>Meal planning and grocery list ideas</li>
                    </ul>
                    <p>What would you like help with today?</p>
                </div>
            </div>
        </div>

        <!-- Suggestion Chips -->
        <div id="suggestionChips" class="px-5 py-3 flex flex-wrap gap-2 bg-gray-50 border-t border-gray-100">
            <button class="suggestion-chip">Suggest a quick recipe</button>
            <button class="suggestion-chip">Low-calorie snack ideas</button>
            <button class="suggestion-chip">What's in season now?</button>
            <button class="suggestion-chip">Healthy dinner options</button>
        </div>

        <!-- Input Box -->
        <form id="aiForm" class="p-4 bg-white border-t border-gray-200 flex items-center space-x-3">
            @csrf
            <div class="flex-1 relative">
                <input type="text" name="query" id="userInput" placeholder="Ask me anything about food, recipes, or nutrition..."
                       class="message-input w-full pr-10" required autocomplete="off">
                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-green-600">
                    <i class="fas fa-paperclip"></i>
                </button>
            </div>
            <button type="submit" id="sendBtn" class="send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </form>
    </div>

    <script>
        const chatWindow = document.getElementById("chatWindow");
        const userInput = document.getElementById("userInput");
        const form = document.getElementById("aiForm");
        const sendBtn = document.getElementById("sendBtn");
        const suggestionChips = document.getElementById("suggestionChips");

        // Function to add chat bubbles
        function addMessage(content, sender = "bot") {
            const isUser = sender === "user";
            
            const msgWrapper = document.createElement("div");
            msgWrapper.classList.add("flex", "items-start", "gap-3");
            if (isUser) {
                msgWrapper.classList.add("justify-end");
            }

            // Add avatar
            const avatar = document.createElement("div");
            avatar.classList.add("w-8", "h-8", "flex-shrink-0", "flex", "items-center", "justify-center", "rounded-full", "text-sm", "font-semibold", "shadow-sm");
            
            if (isUser) {
                avatar.classList.add("bg-green-600", "text-white");
                avatar.innerText = "You";
            } else {
                avatar.classList.add("bg-white");
                avatar.innerText = "🤖";
            }

            let bubble = document.createElement("div");
            bubble.classList.add("px-4", "py-3", "prose", "max-w-full");
            
            if (isUser) {
                bubble.classList.add("user-message");
                // Sanitize user input before displaying
                const textNode = document.createTextNode(content);
                bubble.appendChild(textNode);
            } else {
                bubble.classList.add("bot-message");
                // Use marked.js to render bot response as Markdown
                bubble.innerHTML = marked.parse(content);
            }

            if (isUser) {
                msgWrapper.appendChild(bubble);
                msgWrapper.appendChild(avatar);
            } else {
                msgWrapper.appendChild(avatar);
                msgWrapper.appendChild(bubble);
            }
            
            chatWindow.appendChild(msgWrapper);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }

        // Handle form submission
        async function handleQuery(query) {
            if (!query) return;

            addMessage(query, "user");
            userInput.value = "";
            sendBtn.disabled = true;

            // Hide suggestion chips after first interaction
            suggestionChips.style.display = 'none';

            // Show "Typing..." indicator
            const typingIndicator = document.createElement("div");
            typingIndicator.id = "typing-indicator";
            typingIndicator.classList.add("flex", "items-start", "gap-3");
            typingIndicator.innerHTML = `
                <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center bg-white rounded-full text-sm shadow-sm">🤖</div>
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            `;
            chatWindow.appendChild(typingIndicator);
            chatWindow.scrollTop = chatWindow.scrollHeight;

            try {
                const res = await fetch("{{ route('ai.suggest') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ query: query })
                });

                const data = await res.json();
                
                if (data.answer) {
                    addMessage(data.answer, "bot");
                } else {
                    addMessage(data.error || "I'm sorry, I couldn't process your request. Please try again.", "bot");
                }
            } catch (error) {
                addMessage("I'm having trouble connecting right now. Please check your internet connection and try again.", "bot");
            } finally {
                // Remove typing indicator
                const indicator = document.getElementById("typing-indicator");
                if (indicator) indicator.remove();
                
                sendBtn.disabled = false;
            }
        }

        // Event listeners
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            handleQuery(userInput.value.trim());
        });

        userInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault();
                handleQuery(userInput.value.trim());
            }
        });

        suggestionChips.addEventListener('click', (e) => {
            if (e.target.classList.contains('suggestion-chip')) {
                const query = e.target.innerText;
                userInput.value = query;
                handleQuery(query);
            }
        });

        window.addEventListener('load', () => {
            userInput.focus();
        });
    </script>
</body>
</html>