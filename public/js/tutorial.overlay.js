document.addEventListener('DOMContentLoaded', function() {
    // Retrieve the tutorial name from the global configuration.
    const tutorialName = window.tutorialConfig && window.tutorialConfig.tutorialName;
    const startTutorialButton = document.getElementById('start-tutorial');
    const psipTutorialButton = document.getElementById('start-second-tutorial');
    if (startTutorialButton) {
        startTutorialButton.addEventListener('click', function() {

            //alert(tutorialName);
            // Show all elements whose IDs begin with "tutorial-overlay"
            showTutorialTargets();
            // Start the tutorial using the tutorialName from global config.
            startTutorial(tutorialName);
        });
    }

    if (psipTutorialButton) {
        psipTutorialButton.addEventListener('click', function() {
            //alert(tutorialName);
            // Show all elements whose IDs begin with "tutorial-overlay"
            showTutorialTargets();
            // Start the tutorial using the tutorialName from global config.

            startTutorial(tutorialName);
        });
    }
});

function startTutorial(tutorialName) {
    fetch(`/tutorial/${tutorialName}`, {
        credentials: 'include', // ensures cookies are sent (for session-based auth)
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not OK: ' + response.status);
        }
        return response.json();
    })
    .then(steps => {
        if (steps && steps.length > 0) {
            //Disables scrolling. As scrolling during the tour may misalign tour tooltips, resulting in the tour tooltip being offscreen/non-clickable.
            document.body.classList.add("stop-scrolling");  
            runTutorialSteps(steps, tutorialName);
        }
    })
    .catch(error => {
        console.log('Error fetching tutorial steps:', error);
    });
}

function runTutorialSteps(steps, tutorialName) {
    let currentStepIndex = 0;
    const overlay = createOverlay();
    document.body.appendChild(overlay);
    // Optionally add a fade effect after a short delay.
    setTimeout(() => { overlay.classList.toggle('fade'); }, 300);

    // Variable to store the currently highlighted element.
    let currentHighlighted = null;

    // Helper function to highlight an element.
    function highlightElement(element) {
        if (currentHighlighted) {
            currentHighlighted.classList.remove('tutorial-highlight');
        }
        element.classList.add('tutorial-highlight');
        currentHighlighted = element;
    }

    function showStep(index) {
        removeExistingTooltip();

        // End the tutorial if no more steps.
        if (index < 0 || index >= steps.length) {
            endTutorial();
            return;
        }

        const step = steps[index];
        const targetElement = document.querySelector(step.selector);
        
        //Checks for the edit psip description tour selector, and the role id linked to ict|contributor. As these roles have partial access to editing PSIP descriptions.
        //This is done as the first check to determine if the edit description tour step should be skipped.
        //The second check is for whether or not the user's divsion id matches the PSIP's division id. 
        //If not then skip the step, as the button wouldn't be on the page
        if(step.selector == "#tutorial-details-2-ns" && (window.roleid == 34)){ 
            if((window.userdivid != window.psipdivid)){ 
                nextStep(); 
                return;
            }
        }

        if(step.selector.includes('-ns')){ //The next step could be clicked on and would interrupt the tour, such selectors have -ns added at the end. -ns = non static.
            var tempstep = step.selector.replace("#","");   //Remove the hashtag from the selector to make searching eaiser.
            if(!(document.getElementById(tempstep).classList.contains('tutorial-disable'))){ //If the class hasn't been added, then add it. 
                document.getElementById(tempstep).classList.add('tutorial-disable'); //Add a class that prevents clicking. 
            }
        }

        if (!targetElement) {
            console.warn(`Element not found for selector: ${step.selector}`);
            nextStep();
            return;
        }

        // Highlight the target element.
        highlightElement(targetElement);

        // Create the tooltip and append it to the overlay.
        const tooltip = createTooltip(step.text);
        overlay.appendChild(tooltip);   // Append tooltip first...
        positionTooltip(targetElement, tooltip); // ...then position it

        // If this is the first step, hide the Back button.
        if (index === 0) {
            const backBtn = tooltip.querySelector('#back');
            if (backBtn) {
                backBtn.style.display = 'none';
            }
        }
        if (index === steps.length - 1) {
            const nextBtn = tooltip.querySelector('#continue');
            const skipBtn = tooltip.querySelector('#skip');
            if (nextBtn) {
                nextBtn.textContent = 'End tour';
            }
            if (skipBtn) {
                skipBtn.style.display = 'none';
            }
        }
    }


    function nextStep() {
        currentStepIndex++;
        if (currentStepIndex < steps.length) {
            showStep(currentStepIndex);
        } else {
            endTutorial();
        }
    }

    function prevStep() {
        currentStepIndex--;
        if (currentStepIndex >= 0) {
            showStep(currentStepIndex);
        }
    }

    function createOverlay() {
        const overlayDiv = document.createElement('div');
        overlayDiv.className = 'tour-overlay';
        return overlayDiv;
    }

    function createTooltip(text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tour-tooltip';
        tooltip.innerHTML = `<p>${text}</p>`;

        // Create navigation controls container.
        const navContainer = document.createElement('div');
        navContainer.className = 'tour-nav';

        // Create Back button.
        const backBtn = document.createElement('button');
        backBtn.textContent = 'Back';
        backBtn.onclick = prevStep;
        backBtn.id = 'back';  // Assign an ID
        navContainer.appendChild(backBtn);

        // Create Next button.
        const nextBtn = document.createElement('button');
        nextBtn.textContent = 'Next';
        nextBtn.onclick = nextStep;
        nextBtn.id = 'continue'; // assign id "continue"
        navContainer.appendChild(nextBtn);

        // Create Skip Tour button.
        const skipBtn = document.createElement('button');
        skipBtn.textContent = 'Skip Tour';
        skipBtn.onclick = endTutorial;
        skipBtn.id = 'skip'; // assign id "skip"
        navContainer.appendChild(skipBtn);

        tooltip.appendChild(navContainer);
        return tooltip;
    }


    // Revised positionTooltip function (using viewport-relative coordinates)
    function positionTooltip(target, tooltip) {
        const rect = target.getBoundingClientRect();
        const tooltipWidth = tooltip.offsetWidth;
        const tooltipHeight = tooltip.offsetHeight;
        const offset = 10; // gap between target and tooltip

        // Calculate available space on each side
        const spaceRight = window.innerWidth - rect.right;
        const spaceLeft = rect.left;
        const spaceTop = rect.top;
        const spaceBottom = window.innerHeight - rect.bottom;

        // Default to right side if there's enough space
        let position = 'right';

        // Choose a side based on available space:
        if (spaceRight >= tooltipWidth + offset) {
            position = 'right';
        } else if (spaceLeft >= tooltipWidth + offset) {
            position = 'left';
        } else if (spaceTop >= tooltipHeight + offset) {
            position = 'top';
        } else if (spaceBottom >= tooltipHeight + offset) {
            position = 'bottom';
        } else {
            // If none have sufficient space, default to right
            position = 'right';
        }

        let left, top;
        if (position === 'right') {
            left = rect.right + offset;
            top = rect.top + (rect.height / 2) - (tooltipHeight / 2);
        } else if (position === 'left') {
            left = rect.left - tooltipWidth - offset;
            top = rect.top + (rect.height / 2) - (tooltipHeight / 2);
        } else if (position === 'top') {
            left = rect.left + (rect.width / 2) - (tooltipWidth / 2);
            top = rect.top - tooltipHeight - offset;
        } else if (position === 'bottom') {
            left = rect.left + (rect.width / 2) - (tooltipWidth / 2);
            top = rect.bottom + offset;
        }

        tooltip.style.position = 'absolute';
        tooltip.style.left = left + 'px';
        tooltip.style.top = top + 'px';
    }


    function removeExistingTooltip() {
        const existingTooltip = document.querySelector('.tour-tooltip');
        if (existingTooltip) {
            existingTooltip.parentElement.removeChild(existingTooltip);
        }
    }

    function endTutorial() {
        // Remove all overlays from the document.
        document.querySelectorAll('.tour-overlay').forEach(function(overlayElem) {
            overlayElem.classList.toggle('fade');
            setTimeout(() => {
                overlayElem.parentNode.removeChild(overlayElem);
                console.log("Overlay removed");
            }, 500);
        });
        markTutorialComplete(tutorialName);
        if (currentHighlighted) {
            currentHighlighted.classList.remove('tutorial-highlight');
        }
        hideTutorialTargets();
        //Reinstate clicking of non static tour elements by removing the class that prevents it.
        if (tutorialName == "index-page-dataentry"){ //So far only these two elements could interrupt the tour, the rest are example data leading nowhere.
            document.getElementById('tutorial-overlay-mof-listing-ns').classList.remove('tutorial-disable'); 
            document.getElementById('tutorial-sidebar-0-ns').classList.remove('tutorial-disable');

        }
        else if(tutorialName == "psip-page-dataentry-admin-plan" || tutorialName == "psip-page-dataentry-ict-contri"){
            steps.forEach(element => { //All elements of this tour could potentially interrupt.
                var tempstep = element.selector.replace("#","");
                if(document.getElementById(tempstep) != null){  //Used for when a tutorial contains a step that may or may not be included in the tour i.e. the edit psip details step.
                    if((document.getElementById(tempstep).classList.contains('tutorial-disable'))){
                        document.getElementById(tempstep).classList.remove('tutorial-disable');
                    }
                }
            });
        }
        document.body.classList.remove("stop-scrolling"); //Re-enable page scrolling.   
    }

    // Start the tour with the first step.
    showStep(currentStepIndex);
}

function markTutorialComplete(tutorialName) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/mark-tutorial-complete', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ tutorial_name: tutorialName })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.status);
    })
    .catch(error => {
        console.error('Error marking tutorial complete:', error);
    });
}

function showTutorialTargets() {
    const targets = document.querySelectorAll('[id^="hidden-tutorial"]');
    targets.forEach(target => {
        target.style.visibility = 'visible';
    });
    // If an element with id "temp-data" exists, make it visible.

    // const tempData = document.querySelector("#temp-data");
    // if (tempData) {
    //     tempData.style.visibility = 'visible';
    // }
}

function hideTutorialTargets() {
    const targets = document.querySelectorAll('[id^="hidden-tutorial"]');
    targets.forEach(target => {
        target.style.visibility = 'hidden';
    });
}
