<div class="hk-menu">
    <!-- Brand -->
    <div class="menu-header">
				<span>
					<a class="navbar-brand" href="{{ route('admin.index') }}">
						<img class="brand-img img-fluid" src="{{ asset('/') }}assets/img/brand-sm.svg" alt="brand" />
						<img class="brand-img img-fluid" src="{{ asset('/') }}assets/img/Jampack.svg" alt="brand" />
					</a>
					<button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle">
						<span class="icon">
							<span class="svg-icon fs-5">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<line x1="10" y1="12" x2="20" y2="12"></line>
									<line x1="10" y1="12" x2="14" y2="16"></line>
									<line x1="10" y1="12" x2="14" y2="8"></line>
									<line x1="4" y1="4" x2="4" y2="20"></line>
								</svg>
							</span>
						</span>
					</button>
				</span>
    </div>
    <!-- /Brand -->
    <!-- Main Menu -->
    <div data-simplebar class="nicescroll-bar">
        <div class="menu-content-wrap">
            <div class="menu-group">
                <div class="nav-header">
                </div>
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">
                            <i class="fa fa-meteor fs-5 px-2"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.course.index') }}">
                            <i class="fa fa-book fs-5 px-2"></i>
                            <span class="nav-link-text">Course Module</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.student.list') }}">
                            <i class="fa fa-users fs-5 px-2"></i>
                            <span class="nav-link-text">Student Module</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_blog">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-browser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<rect x="4" y="4" width="16" height="16" rx="1" />
												<line x1="4" y1="8" x2="20" y2="8" />
												<line x1="8" y1="4" x2="8" y2="8" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Blog</span>
                        </a>
                        <ul id="dash_blog" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="posts.html"><span class="nav-link-text">Posts</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="add-new-post.html"><span class="nav-link-text">Add New Post</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="post-detail.html"><span class="nav-link-text">Post Detail</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_chat">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
												<line x1="12" y1="11" x2="12" y2="11.01" />
												<line x1="8" y1="11" x2="8" y2="11.01" />
												<line x1="16" y1="11" x2="16" y2="11.01" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Chat</span>
                        </a>
                        <ul id="dash_chat" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="chats.html"><span class="nav-link-text">Chats</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="chats-group.html"><span class="nav-link-text">Groups</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="chats-contact.html"><span class="nav-link-text">Contacts</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_chatpop">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
												<line x1="12" y1="12" x2="12" y2="12.01" />
												<line x1="8" y1="12" x2="8" y2="12.01" />
												<line x1="16" y1="12" x2="16" y2="12.01" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Chat Popup</span>

                        </a>
                        <ul id="dash_chatpop" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="chatpopup.html"><span class="nav-link-text">Direct Message</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="chatbot.html"><span class="nav-link-text">Chatbot</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="email.html">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<rect x="4" y="4" width="16" height="16" rx="2" />
												<path d="M4 13h3l3 3h4l3 -3h3" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Email</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_scrumboard">
									<span class="nav-icon-wrap position-relative">
										<span class="badge badge-sm badge-primary badge-sm badge-pill position-top-end-overflow">3</span>
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-kanban" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<line x1="4" y1="4" x2="10" y2="4" />
												<line x1="14" y1="4" x2="20" y2="4" />
												<rect x="4" y="8" width="6" height="12" rx="2" />
												<rect x="14" y="8" width="6" height="6" rx="2" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Scrumboard</span>
                        </a>
                        <ul id="dash_scrumboard" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="projects-board.html"><span class="nav-link-text">All Boards</span></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="kanban-board.html"><span class="nav-link-text">Project Kanban</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pipeline.html"><span class="nav-link-text">Pipeline Kanban</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_contact">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" />
												<line x1="13" y1="8" x2="15" y2="8" />
												<line x1="13" y1="12" x2="15" y2="12" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Contact</span>
                        </a>
                        <ul id="dash_contact" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.html"><span class="nav-link-text">Contact List</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact-cards.html"><span class="nav-link-text">Contact Cards</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="edit-contact.html"><span class="nav-link-text">Edit Contact</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_file">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<path d="M14 3v4a1 1 0 0 0 1 1h4" />
												<path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
												<path d="M9 15l2 2l4 -4" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">File Manager</span>
                        </a>
                        <ul id="dash_file" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="file-manager-list.html"><span class="nav-link-text">List View</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="file-manager-grid.html"><span class="nav-link-text">Grid View</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.html">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<line x1="15" y1="8" x2="15.01" y2="8" />
												<rect x="4" y="4" width="16" height="16" rx="3" />
												<path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" />
												<path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Gallery</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_task">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-details" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<path d="M13 5h8" />
												<path d="M13 9h5" />
												<path d="M13 15h8" />
												<path d="M13 19h5" />
												<rect x="3" y="4" width="6" height="6" rx="1" />
												<rect x="3" y="14" width="6" height="6" rx="1" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Todo</span>
                            <span class="badge badge-soft-success ms-2">2</span>
                        </a>
                        <ul id="dash_task" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="tasklist.html"><span class="nav-link-text">Tasklist</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="gantt.html"><span class="nav-link-text">Gantt</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_invoice">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-digit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<path d="M14 3v4a1 1 0 0 0 1 1h4" />
												<rect x="9" y="12" width="3" height="5" rx="1" />
												<path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
												<path d="M15 12v5" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Invoices</span>
                        </a>
                        <ul id="dash_invoice" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="invoice-list.html"><span class="nav-link-text">Invoice List</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="invoice-templates.html"><span class="nav-link-text">Invoice Templates</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="create-invoice.html"><span class="nav-link-text">Create Invoice</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="invoice-preview.html"><span class="nav-link-text">Invoice Preview</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_integ">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<polyline points="7 8 3 12 7 16" />
												<polyline points="17 8 21 12 17 16" />
												<line x1="14" y1="4" x2="10" y2="20" />
											</svg>
										</span>
									</span>
                            <span class="nav-link-text">Integrations</span>
                        </a>
                        <ul id="dash_integ" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="all-apps.html"><span class="nav-link-text">All Apps</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="integrations-detail.html"><span class="nav-link-text">App Detail</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="integrations.html"><span class="nav-link-text">Integrations</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Main Menu -->
</div>
<div id="hk_menu_backdrop" class="hk-menu-backdrop"></div>
