<?php
$productSeoTitle = "Report an Issue";
$productSeoDescription = "Report an Issue";
include('include/header.php');
?>
<?php include('include/sidenav.php'); ?>

<main class="offcanvas-enabled">
    <div class="report_page">
        <div class="report_issue d-lg-block d-none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 side_section">
                        <div class="side_bar">
                            <div class="bar">
                                Report an Issue
                            </div>
                            <div class="query_search_section">
                                <div class="input_div">
                                    <input type="text" class="search_query">
                                    <img src="image/report/search_icon.png" alt="">
                                </div>
                                <nav>
                                    <div class="nav border-0 nav-tabs flex-column" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-tab-1" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                            aria-selected="true">
                                            <div class="div_icon"><img src="image/report/Order-confirmation.png" alt="">
                                                <span>Order Confirmation</span>
                                            </div><i class="fa-solid fa-xmark"></i>
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="question_answer_section">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-tab-1">
                                    <ul class="question_list">
                                        <li>
                                            <p><span class="span1">1</span></p>
                                            <div class="q">I couldn’t find the medicine I was looking for / How do I
                                                find the medicine I need?</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- chat div  -->
        <div class="live_chat_section col-lg-8 ms-auto">
            <button class="back-btn"> <img src="image/report/Arrow.png" alt=""> All Questions</button>

            <div class="user">
                Resolved
            </div>

            <div class="chat">
                <div class="from">
                    <p>NP</p>
                </div>
                <p class="answer">
                    We are sorry that you are facing difficulties in finding your required product. You can look for
                    your product by searching for it on the search bar located on the homepage of our website
                </p>
            </div>

            <div class="chat">
                <div class="from">
                    <p>NP</p>
                </div>
                <p class="answer">
                    If our response has resolved your issue, please click on ‘Resolved’ If you are still uncertain,
                    click on ‘Unresolved.’
                </p>
            </div>

            <div class="action_buttons d-lg-flex gap-3 justify-content-center my-4">
                <button class="feedback">Provide Feedback</button>
                <button class="solution">I Got My Solution</button>
            </div>

            <div class="oneTouch">

                <a href=""><img src="image/cartImages/call.png" alt=""></a>
                <a href=""><img src="image/cartImages/chat.png" alt=""></a>

            </div>

            <div class="chat">
                <div class="from">
                    <p>NP</p>
                </div>
                <p class="answer">
                    Or Visit
                    <a href="https://newlandpharmacy.co.uk/">https://newlandpharmacy.co.uk/</a>
                </p>
            </div>

            <div class="additional_buttons">
                <button class="add">Additional Details</button>
                <button class="report">Report</button>
            </div>

            <div class="input_wrapper">
                <input class="" disabled type="text" placeholder="Type Your Feedback">
                <button class="pin">
                    <img src="image/report/pin.png" alt="">
                </button>
                <button class="send">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>

        </div>
        <!-- chat div  -->


        <div class="report_issue_mobile d-lg-none">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <img src="image/report/Order-Confirmation.png" alt="">
                            <span>Order Confirmation</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li>
                                    <p> <span>1</span> </p>
                                    <p>I couldn’t find the medicine I was looking for / How do I find the medicine I
                                        need?
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
<?php include('include/footer.php'); ?>