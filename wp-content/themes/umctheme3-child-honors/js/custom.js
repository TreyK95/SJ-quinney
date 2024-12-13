gsap.registerPlugin(ScrollTrigger);


let imageSection = document.querySelectorAll('.image-section');
imageSection2 = document.querySelectorAll('.image-section2');
imageSectionImage = document.querySelectorAll('.image-section .image-wrapper');
imageSection2Image = document.querySelectorAll('.image-section2 .image-wrapper2');
statsGrid = document.querySelectorAll('.stats-grid .stats-box');


function animateStudentPhotos() {
    gsap.from(imageSectionImage, {
        duration: 2,
        ease: 'power1.out',
        opacity: 0,
        y: 50,
        stagger: 0.2,
        scrollTrigger: {
            trigger: imageSection,
            start: 'top middle',
        },
    });
}
animateStudentPhotos();


function animateStudentPhotos2() {
    gsap.from(imageSection2Image, {
        duration: 2,
        ease: 'power1.out',
        opacity: 0,
        y: 50,
        stagger: 0.2,
        scrollTrigger: {
            trigger: imageSection2,
            start: 'top middle',
        },
    });
}
animateStudentPhotos2();
function animateStatBox() {
    gsap.from(".stat-box", {
        duration: 2,
        ease: 'power1.out',
        opacity: 0,
        x: 50,
        stagger: 0.2,
        scrollTrigger: {
            trigger: ".stats-grid",
            start: 'middle',
        },
    });
}
animateStatBox();


/* Functionality for ADMISSIONS PAGE + MEET THE TEAM Hero selection box */

document.addEventListener('DOMContentLoaded', function () {
    // Get elements for facultyType and studentType dropdowns
    const facultyType = document.getElementById('facultyType');
    const studentType = document.getElementById('studentType');

    // Functionality for the facultyType dropdown (Meet the Team page)
    if (facultyType) {
        facultyType.addEventListener('change', function () {
            const selectedValue = this.value; // Get the selected value
            if (selectedValue) {
                window.location.href = selectedValue; // Redirect to the selected URL
            }
        });
    }

    // Functionality for the studentType dropdown (Honors Admissions page)
    if (studentType) {
        // Mapping student types to parent div IDs
        const studentTypeToDivs = {
            'incoming-first-year': ['pg-131-1', 'pg-131-2', 'pg-131-3', 'pg-131-4', 'pg-131-5', 'pg-131-6'],
            'first-year': ['pg-131-10', 'pg-131-11'],
            'transfer': ['pg-131-7', 'pg-131-8', 'pg-131-9'],
            'upper-division': ['pg-131-12', 'pg-131-13']
        };

        // Array of IDs to exclude from 'display: flex'
        const excludedDivs = ['pg-131-2', 'pg-131-6'];

        studentType.addEventListener('change', function () {
            const selectedValue = this.value;

            // Hide all parent divs by setting display to 'none'
            Object.values(studentTypeToDivs).flat().forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.style.display = 'none';
                }
            });

            // Show the relevant parent divs by setting display to 'flex' or 'block'
            if (studentTypeToDivs[selectedValue]) {
                studentTypeToDivs[selectedValue].forEach(id => {
                    const element = document.getElementById(id);
                    if (element) {
                        // Check if the element is in the excludedDivs array
                        if (!excludedDivs.includes(id)) {
                            element.style.display = 'flex'; // Apply 'flex' if it's not excluded
                        } else {
                            element.style.display = 'block'; // Apply 'block' if it's excluded
                        }
                    }
                });
            }
        });

        // Functionality to trigger the "upper-division" view
        function showUpperDivision() {
            // Set the dropdown to 'upper-division'
            studentType.value = 'upper-division';

            // Trigger the 'change' event to show the upper-division content
            studentType.dispatchEvent(new Event('change'));
        }

        document.querySelectorAll('.show-upper-division-link').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                showUpperDivision();
            });
        });
    }
});


//NEWELL LECTURES DROPDOWN FUNCTIONALITY
jQuery(document).ready(function($) {
    $('#filter-button').on('click', function() {
        FWP.refresh(); // Trigger FacetWP to refresh the filters
    });
});

jQuery(document).ready(function($) {
    function initializeAccordion() {
        const imgDown = '<img src="https://stage.honors.umc.utah.edu/wp-content/uploads/sites/106/2024/12/Vector-1.png" alt="Expand">';
        const imgUp = '<img src="https://stage.honors.umc.utah.edu/wp-content/uploads/sites/106/2024/12/Vector-11.png" alt="Collapse">';

        // Initialize state from localStorage
        $('.lecture-details').each(function(index) {
            const stateKey = `lecture-details-${index}`;
            const isVisible = localStorage.getItem(stateKey) === 'true';

            if (isVisible) {
                $(this).show(); // Keep it visible if previously expanded
                $(this).siblings('.lecture-header').find('.expand-button').html(imgUp);
            } else {
                $(this).hide(); // Ensure it stays hidden
                $(this).siblings('.lecture-header').find('.expand-button').html(imgDown);
            }
        });

        // Toggle lecture details
        $('.expand-button').off('click').on('click', function() {
            const button = $(this);
            const details = button.closest('.lecture-header').siblings('.lecture-details');
            const isVisible = details.is(':visible');
            const index = $('.lecture-details').index(details);

            // Save the new state immediately
            localStorage.setItem(`lecture-details-${index}`, !isVisible);

            // Update UI dynamically without reload
            details.slideToggle(200, function() {
                // Update button image based on final visibility
                button.html(details.is(':visible') ? imgUp : imgDown);
            });
        });
    }

    initializeAccordion();

    // Reinitialize on FacetWP reload
    $(document).on('facetwp-loaded', function() {
        initializeAccordion();
    });
});



