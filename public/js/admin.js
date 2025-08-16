// Modern Admin Panel JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    
    if (sidebarCollapse) {
        sidebarCollapse.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
            
            // Add overlay for mobile
            let overlay = document.querySelector('.sidebar-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);
            }
            
            if (sidebar.classList.contains('active')) {
                overlay.classList.add('active');
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    content.classList.remove('active');
                    overlay.classList.remove('active');
                });
            } else {
                overlay.classList.remove('active');
            }
        });
    }

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    });

    // Confirm delete actions
    const deleteForms = document.querySelectorAll('form[action*="destroy"]');
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

    // Image preview functionality
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(function(input) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = input.parentElement.querySelector('#imagePreview');
            const previewImg = input.parentElement.querySelector('#previewImg');
            
            if (file && previewContainer && previewImg) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    });

    // Form validation enhancement
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = form.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });

    // Real-time character counter for textareas
    const textareas = document.querySelectorAll('textarea[maxlength]');
    textareas.forEach(function(textarea) {
        const maxLength = parseInt(textarea.getAttribute('maxlength'));
        const counter = document.createElement('div');
        counter.className = 'form-text text-end';
        counter.textContent = `${textarea.value.length}/${maxLength}`;
        textarea.parentElement.appendChild(counter);
        
        textarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            counter.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength > maxLength * 0.9) {
                counter.classList.add('text-warning');
            } else {
                counter.classList.remove('text-warning');
            }
            
            if (currentLength > maxLength) {
                counter.classList.add('text-danger');
            } else {
                counter.classList.remove('text-danger');
            }
        });
    });

    // Table row selection
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(function(row) {
        row.addEventListener('click', function(e) {
            // Don't trigger if clicking on buttons or links
            if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' || e.target.tagName === 'I') {
                return;
            }
            
            // Toggle selection
            this.classList.toggle('table-active');
        });
    });

    // Bulk actions
    const bulkActionSelect = document.querySelector('#bulkAction');
    const bulkActionBtn = document.querySelector('#bulkActionBtn');
    
    if (bulkActionSelect && bulkActionBtn) {
        bulkActionSelect.addEventListener('change', function() {
            const selectedAction = this.value;
            if (selectedAction) {
                bulkActionBtn.textContent = `Apply ${selectedAction}`;
                bulkActionBtn.disabled = false;
            } else {
                bulkActionBtn.textContent = 'Apply Action';
                bulkActionBtn.disabled = true;
            }
        });
    }

    // Search functionality
    const searchInput = document.querySelector('#searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(function(row) {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // Auto-save draft functionality
    let autoSaveTimer;
    const contentEditor = document.querySelector('#content');
    
    if (contentEditor) {
        contentEditor.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(function() {
                // Save draft to localStorage
                const formData = new FormData(document.querySelector('form'));
                const draftData = {
                    title: formData.get('title') || '',
                    content: formData.get('content') || '',
                    excerpt: formData.get('excerpt') || '',
                    category_id: formData.get('category_id') || '',
                    timestamp: new Date().toISOString()
                };
                
                localStorage.setItem('postDraft', JSON.stringify(draftData));
                
                // Show auto-save notification
                showNotification('Draft auto-saved', 'info');
            }, 3000); // Auto-save after 3 seconds of inactivity
        });
    }

    // Load draft on page load
    const savedDraft = localStorage.getItem('postDraft');
    if (savedDraft && window.location.pathname.includes('/create')) {
        try {
            const draft = JSON.parse(savedDraft);
            const titleInput = document.querySelector('#title');
            const contentInput = document.querySelector('#content');
            const excerptInput = document.querySelector('#excerpt');
            const categorySelect = document.querySelector('#category_id');
            
            if (titleInput && draft.title) titleInput.value = draft.title;
            if (contentInput && draft.content) contentInput.value = draft.content;
            if (excerptInput && draft.excerpt) excerptInput.value = draft.excerpt;
            if (categorySelect && draft.category_id) categorySelect.value = draft.category_id;
            
            // Show draft restored notification
            showNotification('Draft restored from auto-save', 'info');
        } catch (e) {
            console.error('Error loading draft:', e);
        }
    }

    // Clear draft when form is submitted successfully
    const submitForms = document.querySelectorAll('form');
    submitForms.forEach(function(form) {
        form.addEventListener('submit', function() {
            localStorage.removeItem('postDraft');
        });
    });

    // Initialize Quill.js editor constraints
    initializeQuillEditor();
});

// Utility function to show notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(function() {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Quill.js editor initialization and constraints
function initializeQuillEditor() {
    // Wait for Quill.js to be ready
    setTimeout(function() {
        constrainQuillEditor();
        
        // Also run on window resize
        window.addEventListener('resize', constrainQuillEditor);
        
        // Run periodically to ensure constraints are maintained
        setInterval(constrainQuillEditor, 2000);
        
        // Fix Quill.js positioning issues
        fixQuillPositioning();
        
        // Enhance toolbar appearance
        enhanceToolbarAppearance();
    }, 1000);
}

// Enhance toolbar appearance and functionality
function enhanceToolbarAppearance() {
    const toolbars = document.querySelectorAll('.ql-toolbar');
    toolbars.forEach(function(toolbar) {
        if (toolbar) {
            // Add hover effects to format groups
            const formatGroups = toolbar.querySelectorAll('.ql-formats');
            formatGroups.forEach(function(group) {
                group.addEventListener('mouseenter', function() {
                    this.style.background = 'rgba(99, 102, 241, 0.05)';
                });
                
                group.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('has-active')) {
                        this.style.background = 'transparent';
                    }
                });
            });
            
            // Monitor active states
            const buttons = toolbar.querySelectorAll('button');
            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Update parent format group
                    const formatGroup = this.closest('.ql-formats');
                    if (formatGroup) {
                        const hasActive = formatGroup.querySelector('.ql-active');
                        if (hasActive) {
                            formatGroup.classList.add('has-active');
                        } else {
                            formatGroup.classList.remove('has-active');
                        }
                    }
                });
            });
            
            // Add visual feedback for active states
            setInterval(function() {
                formatGroups.forEach(function(group) {
                    const hasActive = group.querySelector('.ql-active');
                    if (hasActive) {
                        group.classList.add('has-active');
                    } else {
                        group.classList.remove('has-active');
                    }
                });
            }, 100);
        }
    });
}

// Quill.js size constraint function
function constrainQuillEditor() {
    const editors = document.querySelectorAll('.ql-editor');
    editors.forEach(function(editor) {
        if (editor) {
            // Force container constraints
            editor.style.width = '100%';
            editor.style.maxWidth = '100%';
            editor.style.overflow = 'visible';
            
            // Force inner elements to respect container
            const innerElements = editor.querySelectorAll('*');
            innerElements.forEach(function(element) {
                element.style.maxWidth = '100%';
                element.style.boxSizing = 'border-box';
            });
        }
    });
    
    // Also constrain toolbar and container
    const toolbars = document.querySelectorAll('.ql-toolbar');
    toolbars.forEach(function(toolbar) {
        if (toolbar) {
            toolbar.style.width = '100%';
            toolbar.style.maxWidth = '100%';
            toolbar.style.overflow = 'visible';
        }
    });
    
    const containers = document.querySelectorAll('.ql-container');
    containers.forEach(function(container) {
        if (container) {
            container.style.width = '100%';
            container.style.maxWidth = '100%';
            container.style.overflow = 'visible';
        }
    });
}

// Fix Quill.js positioning issues
function fixQuillPositioning() {
    const editors = document.querySelectorAll('.ql-editor');
    editors.forEach(function(editor) {
        if (editor) {
            // Ensure proper z-index and positioning
            editor.style.position = 'relative';
            editor.style.zIndex = '1';
            
            // Ensure editor doesn't overflow its container
            const container = editor.closest('.card-body, .form-content');
            if (container) {
                container.style.position = 'relative';
                container.style.zIndex = '1';
                container.style.overflow = 'visible';
            }
        }
    });
    
    // Fix toolbar positioning
    const toolbars = document.querySelectorAll('.ql-toolbar');
    toolbars.forEach(function(toolbar) {
        if (toolbar) {
            toolbar.style.position = 'relative';
            toolbar.style.zIndex = '2';
        }
    });
    
    // Fix container positioning
    const containers = document.querySelectorAll('.ql-container');
    containers.forEach(function(container) {
        if (container) {
            container.style.position = 'relative';
            container.style.zIndex = '1';
        }
    });
}

// Export functions for global use
window.AdminPanel = {
    showNotification: showNotification,
    confirmDelete: function(message = 'Are you sure?') {
        return confirm(message);
    },
    constrainQuillEditor: constrainQuillEditor,
    fixQuillPositioning: fixQuillPositioning,
    enhanceToolbarAppearance: enhanceToolbarAppearance
};
