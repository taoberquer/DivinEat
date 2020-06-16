$(document).ready(function() {
    
    var pageBuilderHandler = {

        page: null,
        elements: null,
        draggedElement: null,
        dropperRow: null,
        dropper: null,
        droppers: null,
        container: null,
        containerToolBar: null,
        pageData: {},
        idEditor: 0,

        init: function() {
            // this.applyDragEvents();
            // this.applyDropEvents();
            pageBuilderHandler.page = document.querySelector('.page');
            this.initCreateContainerBtn(document.querySelector('.pageBuilder-btn-add'), pageBuilderHandler.page);
        },

        initCreateContainerBtn: function (button, parent) {
            button.addEventListener('click', function (e) {
                var container = this.parentNode;
                
                pageBuilderHandler.createStructureBtnBar(container, parent);
            });
        },

        createStructureBtnBar: function(container, parent) {
            var pageBuilderHandler = this;

            var containerNodes = [];
            container.childNodes.forEach(node => {
                containerNodes.push(node);
            });
            containerNodes.forEach(node => {
                container.removeChild(node);
            });

            var structureBtnBar = document.createElement('div');
            var cancelBtn = document.createElement('div');
            var btn1 = document.createElement('div');
            var btn2 = document.createElement('div');
            var btn3 = document.createElement('div');
            var btn4 = document.createElement('div');
            var btn5 = document.createElement('div');
            var btn6 = document.createElement('div');
            var btn7 = document.createElement('div');

            structureBtnBar.className = 'pageBuilder-container-list-structure-bar';
            btn1.className = 'pageBuilder-container-structure-btn-12';
            btn2.className = 'pageBuilder-container-structure-btn-6_6';
            btn3.className = 'pageBuilder-container-structure-btn-4_4_4';
            btn4.className = 'pageBuilder-container-structure-btn-3_3_3_3';
            btn5.className = 'pageBuilder-container-structure-btn-3_6_3';
            btn6.className = 'pageBuilder-container-structure-btn-6_3_3';
            btn7.className = 'pageBuilder-container-structure-btn-3_3_6';
            cancelBtn.className = 'pageBuilder-btn-cancel';
            cancelBtn.innerHTML = 'x';

            structureBtnBar.appendChild(btn1);
            structureBtnBar.appendChild(btn2);
            structureBtnBar.appendChild(btn3);
            structureBtnBar.appendChild(btn4);
            structureBtnBar.appendChild(btn5);
            structureBtnBar.appendChild(btn6);
            structureBtnBar.appendChild(btn7);

            container.appendChild(structureBtnBar);
            container.appendChild(cancelBtn);

            cancelBtn.addEventListener('click', function (e) {
                container.removeChild(structureBtnBar);
                container.removeChild(cancelBtn);
                containerNodes.forEach(node => {
                    container.appendChild(node);
                });
            });

            pageBuilderHandler.addEventsToStructureBtn(structureBtnBar, container, parent);
        },

        addEventsToStructureBtn: function(structureBtnBar, container, parent) {
            var pageBuilderHandler = this;
            var containerParent = container.parentNode;
            structureBtnBar.childNodes.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    containerParent.removeChild(container);

                    var className = this.className.substring(36);
                    var colsSize = className.split('_');
                    
                    var parentRow = document.createElement('div');
                    parentRow.className = 'row padding-0';

                    containerParent.appendChild(parentRow);

                    colsSize.forEach(colSize => {
                        let col = document.createElement('div');
                        let colInner = document.createElement('div');
                        let container = document.createElement('div');
                        let addBtn = document.createElement('div');

                        col.className = 'col-sm-' + colSize + ' padding-0';
                        colInner.className = 'col-inner';
                        if (parent == null)
                            colInner.className += ' padding-top-0';
                        container.className = 'pageBuilder-container-displayed-empty';
                        addBtn.className = 'pageBuilder-btn-add';
                        addBtn.innerHTML = '+';

                        addBtn.addEventListener('click', function(e) { 
                            var addItemBtn = document.createElement('div');
                            var newStructureBtn = document.createElement('div');

                            addItemBtn.className = 'pageBuilder-btn-add';
                            addItemBtn.innerHTML = '+';
                            newStructureBtn.className = 'pageBuilder-container-structure-btn-small';
                                
                            container.appendChild(addItemBtn);
                            container.appendChild(newStructureBtn);
                                
                            newStructureBtn.addEventListener('click', function(e) {
                                pageBuilderHandler.createStructureBtnBar(container, null);
                                // container.removeChild(addItemBtn);
                                // container.removeChild(newStructureBtn);
                            });

                            container.removeChild(this);
                        });

                        container.appendChild(addBtn);
                        colInner.appendChild(container);
                        col.appendChild(colInner);
                        parentRow.appendChild(col);
                    });

                    var newRow = document.createElement('div');
                    var newCol = document.createElement('div');
                    var newColInner = document.createElement('div');
                    var newContainer = document.createElement('div');
                    var newAddContainerBtn = document.createElement('div');

                    newRow.className = 'row padding-0';
                    newCol.className = 'col-sm-12 padding-0';
                    newColInner.className = 'col-inner padding-0';
                    newContainer.className = 'pageBuilder-container-hidden';
                    container.className = 'pageBuilder-container-displayed';
                    newAddContainerBtn.className = 'pageBuilder-btn-add';
                    newAddContainerBtn.innerHTML = '+';

                    if(parent == null)
                        parent = parentRow.parentNode;

                    parent.appendChild(newRow);
                    newRow.appendChild(newCol);
                    newCol.appendChild(newColInner);
                    newColInner.appendChild(newContainer);
                    newContainer.appendChild(newAddContainerBtn);
                    pageBuilderHandler.initCreateContainerBtn(newAddContainerBtn, null);
                });
            });
        },

        createContainer: function(parent) {
            var pageBuilderHandler = this;
            var row = document.createElement('div');
            var col = document.createElement('div');
            var colInner = document.createElement('div');
            var container = document.createElement('div');
            
            row.className = 'row padding-0';
            col.className = 'col-sm-12 padding-0';
            colInner.className = 'col-inner';
            container.className = 'pageBuilder-container-displayed';

            parent.appendChild(row);
            row.appendChild(col);
            col.appendChild(colInner);
            colInner.appendChild(container);

            container.addEventListener('mouseenter', function(e) {
                pageBuilderHandler.container = this;
            });
            container.addEventListener('mouveleave', function(e) {
                pageBuilderHandler.container = null;
            });

            return container;
        },










        addPositionButtons: function(container) {
            var pageBuilderHandler = this;
            var containerCol = container.parentNode.parentNode.parentNode.parentNode.parentNode;
            var containerRow = containerCol.parentNode;
            var page = containerRow.parentNode;

            var isRightContainer = false;
            var isLeftContainer = false;
            var isTopContainer = false;
            var isBottomContainer = false;

            var rowNodesLength = containerRow.childNodes.length;


            if (containerRow.childNodes[1] == containerCol) {
                isLeftContainer = true;
            }
            if (containerRow.childNodes[rowNodesLength-2] == containerCol) {
                isRightContainer = true;
            }

            if (page.childNodes[1] == containerRow) {
                isTopContainer = true;
            }

            if (page.childNodes[page.childNodes.length-2] == containerRow) {
                isBottomContainer = true;
            }

            if (!isLeftContainer) {
                var leftBtn = document.createElement('div');
                leftBtn.className = 'pageBuilder-container-btn-position-left';
                container.appendChild(leftBtn);
            }

            if (!isRightContainer) {
                var rightBtn = document.createElement('div');
                rightBtn.className = 'pageBuilder-container-btn-position-right';
                container.appendChild(rightBtn);
            }

            if (!isTopContainer) {
                var topBtn = document.createElement('div');
                topBtn.className = 'pageBuilder-container-btn-position-top';
                container.appendChild(topBtn);
            }

            if (!isBottomContainer) {
                var bottomBtn = document.createElement('div');
                bottomBtn.className = 'pageBuilder-container-btn-position-bottom';
                container.appendChild(bottomBtn);
            }

        },

        addToolsBar: function(container) {
            var pageBuilderHandler = this;
            var pageData = pageBuilderHandler.pageData;
            var toolsBarItemsList = [];
            var toolsBar = document.createElement('div');
            toolsBar.className = 'pageBuilder-container-tools-bar';
            
            var toolsBarGear = document.createElement('div');
            var gearIcon = document.createElement('img');
            toolsBarGear.className = 'pageBuilder-container-tools-bar-item';
            gearIcon.src = '../img/icones/gear.png';
            gearIcon.style.width = '65%';

            toolsBarGear.appendChild(gearIcon);
            toolsBar.appendChild(toolsBarGear);

            for (let i = 0; i < 2; i++) {
                let sizeBtn = document.createElement('div');
                let nbCol = 2; // the first button is used to divise in 2 columns
                if (i > 0) nbCol = 3; // the second button is used to divise in 3 columns 

                toolsBarItemsList.push(sizeBtn);
                
                sizeBtn.className = 'pageBuilder-container-tools-bar-item-hidden';
                var colIcon = document.createElement('img');

                if (i == 0) colIcon.src = '../img/icones/2columns.png';
                else if (i == 1) colIcon.src = '../img/icones/3columns.png';
                
                colIcon.style.width = '50%';
                sizeBtn.appendChild(colIcon);
                
                sizeBtn.addEventListener('click', function (e) {
                    let mainColInner = pageBuilderHandler.container.parentNode;
                    let mainCol = mainColInner.parentNode;
                    let mainRow = mainCol.parentNode;
                    let numContainer = 1;
                    let containerId = container.id;
                    
                    mainColInner.removeChild(container);
                    mainColInner.className = 'col-inner padding-0';
                    mainCol.className = 'col-sm-' + (12 / nbCol) + ' padding-0';
                    
                    for (let i = 0; i < nbCol; i++) {
                        if (i == 0) {
                            let containerRow = document.createElement('div');
                            let containerCol = document.createElement('div');
                            let containerColInner = document.createElement('div');

                            containerRow.className = 'row padding-0';
                            containerCol.className = 'col-sm-12 padding-0';
                            containerColInner.className = 'col-inner';

                            mainColInner.appendChild(containerRow);
                            containerRow.appendChild(containerCol);
                            containerCol.appendChild(containerColInner);
                            containerColInner.appendChild(container);
                            container.id = containerId + '-' + numContainer;
                            pageData[containerId + '-' + numContainer] = pageData[containerId];
                        } else {
                            let newCol = document.createElement('div');
                            let newColInner = document.createElement('div');
                            let newContainer = pageBuilderHandler.createContainer(newColInner);

                            // pageBuilderHandler.applyDropEvents(newContainer);

                            newCol.className = 'col-sm-' + (12 / nbCol) + ' padding-0';
                            newColInner.className = 'col-inner padding-0';

                            var toolsBar = pageBuilderHandler.addToolsBar(newContainer);
                            newCol.appendChild(newColInner);
                            mainRow.appendChild(newCol);
                            numContainer = i+1;
                            newContainer.id = containerId + '-' + numContainer;
                            pageData[containerId + '-' + numContainer] = null;
                        }                      
                    }

                    delete pageData[containerId];
                });
                toolsBar.appendChild(sizeBtn);
            }

            var deleteContainerBtn = document.createElement('div');
            toolsBarItemsList.push(deleteContainerBtn);
            deleteContainerBtn.className = 'pageBuilder-container-tools-bar-item-hidden';
            var binIcon = document.createElement('img');
            binIcon.src = '../img/icones/trash.png';
            binIcon.style.width = '50%';

            deleteContainerBtn.addEventListener('click', function(e) {
                pageBuilderHandler.deleteContainer(container);
            });
            
            deleteContainerBtn.appendChild(binIcon);
            toolsBar.appendChild(deleteContainerBtn);

            toolsBar.addEventListener('mouseenter', function (e) {

                toolsBarGear.className = 'pageBuilder-container-tools-bar-item-hidden';
                
                toolsBarItemsList.forEach(item => {
                    item.className = 'pageBuilder-container-tools-bar-item';
                });

            });

            toolsBar.addEventListener('mouseleave', function (e) {
                toolsBarGear.className = 'pageBuilder-container-tools-bar-item';
                toolsBarItemsList.forEach(item => {
                    item.className = 'pageBuilder-container-tools-bar-item-hidden';
                });

            });

            container.addEventListener('mouseenter', function (e) {
                toolsBar.style.display = 'flex';
                pageBuilderHandler.toolsBar = toolsBar;
            });

            container.addEventListener('mouseleave', function (e) {
                toolsBar.style.display = 'none';
                pageBuilderHandler.toolsBar = null;
            });

            container.appendChild(toolsBar);
            return toolsBar;
        },

        
        deleteContainer: function(container) {
            var pageBuilderHandler = this;
            var pageData = pageBuilderHandler.pageData;
            var containerMainCol = container.parentNode.parentNode.parentNode.parentNode.parentNode;
            var containerMainRow = containerMainCol.parentNode;
            var colSize = null;
            var classNameElement = null;
            var orphanContainerRow = null;
            var orphanContainer = null;

            containerMainCol.classList.forEach(className => {
                if (className.includes('col-sm-')) {
                    classNameElement = className;
                    colSize = className.substring(7);
                }
            });

            var newColSize = colSize == 12 ? 0 : 12 / (12 / colSize - 1);
            
            delete pageData[container.id];

            if (newColSize == 0) {
                
                containerMainRow.parentNode.removeChild(containerMainRow);

            } else {
            
                var containerMainColInner = containerMainRow.parentNode;
                containerMainRow.removeChild(containerMainCol);

                if (newColSize == 12) {

                    orphanContainerRow = containerMainRow.childNodes[0].childNodes[0].childNodes[0];
                    orphanContainer = orphanContainerRow.childNodes[0].childNodes[0].childNodes[0]
                    containerMainColInner.removeChild(containerMainRow);
                    containerMainColInner.appendChild(orphanContainerRow);

                    var pageDataOrphanContainer = pageData[orphanContainer.id];
                    var newId = orphanContainer.id.substring(0, orphanContainer.id.length - 2);
                    pageData[newId] = pageDataOrphanContainer;
                    
                    delete pageData[orphanContainer.id];
                    orphanContainer.id = newId;

                } else {
                    
                    containerMainRow.childNodes.forEach(col => {
                        col.className = col.className.replace(classNameElement, 'col-sm-' + newColSize);
                    });

                }   
            }
        },

        addEditor: function(container, editorData = null, button = null) {
            var pageBuilderHandler = this;
            var validateButton;

            pageBuilderHandler.idEditor++;
            var idEditorContainer = 'editorjs' + this.idEditor;
            
            if (editorData == null) {
                validateButton = document.createElement('div');    
                
                // checkIcon.src = '../img/icones/check.png';
                // checkIcon.style.width = '50%';
                // validateButton.appendChild(checkIcon);   
                container.appendChild(validateButton);     
            } else {
                validateButton = button;
                // validateButton.firstChild.src = '../img/icones/check.png';
            }

            var editor = new EditorJS({
                /**
                 * Id of Element that should contain Editor instance
                 */
                holder: idEditorContainer,
                placeholder: 'C\'est là qu\'on écrit',
                minHeight: 4,

                /** 
                 * Available Tools list. 
                 * Pass Tool's class or Settings object for each Tool you want to use 
                 */
                tools: {
                    header: {
                        class: Header,
                        shortcut: 'CMD+SHIFT+H',
                        config: {
                            placeholder: 'Enter a header',
                            levels: [1, 2, 3, 4],
                            defaultLevel: 1
                        }
                    },
                    list: {
                        class: List,
                        inlineToolbar: true,
                        shortcut: 'CMD+SHIFT+L',
                    },

                    embed: {
                        class: Embed,
                    },
                },

                data: editorData
            });

            var editorContainer = document.createElement('div');
            editorContainer.className = 'pageBuilder-editor-container';
            editorContainer.id = idEditorContainer;

            container.appendChild(editorContainer);
            
            validateButton.className = 'pageBuilder-container-btn-validate';
            validateButton.addEventListener('click', function(e) {
                pageBuilderHandler.saveEditor(editor, editorContainer, validateButton);
            });

        },

        saveEditor: function(editor, editorContainer, button) {
            var pageBuilderHandler = this;

            editor.save().then((outputData) => {
                var htmlData = pageBuilderHandler.convertEditorTextToHTML(outputData);
                var container = editorContainer.parentNode;

                pageBuilderHandler.pageData[container.id] = outputData;

                editor.destroy();
                editorContainer.innerHTML = htmlData;

                button.className = 'pageBuilder-container-btn-edit';
                // button.firstChild.src = '../../../../../img/icones/edit-tools.png';

                button.addEventListener('click', function(e) {

                    container.removeChild(editorContainer);
                    // pageBuilderHandler.addEditor(container, outputData, button);

                });

            }).catch((error) => {
                console.log('Saving failed: ', error);
            });
        },

        convertEditorTextToHTML: function(data) {
            var blocks = data.blocks;
            var htmlData = '';
            blocks.forEach((block, index) => {
                var type = block['type'];
                
                if(index != 0 && index != blocks.length) {
                    htmlData += '<br>';
                }

                switch (type) {
                    case 'paragraph':
                        var text = block['data'].text;
                        htmlData += '<p>' + text + '</p>';
                        break;

                    case 'list':
                        var listItems = block['data'].items;
                        var style = block['data'].style;
                        
                        htmlData += '<ul>';

                        listItems.forEach((item, index) => {

                            if (style == 'ordered') {
                                htmlData += '<li style="list-style: none;">';
                                htmlData += ++index + '. ';
                            } else {
                                htmlData += '<li>';
                            }

                            htmlData += item + '</li>';
                        });

                        htmlData += '</ul>';
                        break;

                    case 'header':
                        var text = block['data'].text;
                        var level = block['data'].level;
                        htmlData += '<h' + level + '>' + text + '</h' + level + '>';
                        break;
                
                    default:
                        break;
                }
            });
            return htmlData;
        },

        addImageItem: function(container) {
            var input = document.createElement("input");
            input.setAttribute("type", "file");

            container.appendChild(input);
        },

        addElementToPageContent: function(element) {

        }
    };

    pageBuilderHandler.init();
});