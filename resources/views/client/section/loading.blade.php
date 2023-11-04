<style>
    #loading {
        background: transparent;
        border: 7px solid #f66962;
        border-left: 7px solid transparent;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        display: none;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    
    </style>
<div id="loading"></div>
