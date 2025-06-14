<x-layouts.app :title="__('Information')">
    <style>
        .container {
            max-width: 960px;
            margin: auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            padding: 10px 30px;
        }
        .dark .container {
            background: #1e1e1e;
            box-shadow: 0 8px 24px rgba(255,255,255,0.05);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 30px;
        }
        .title {
            font-size: 24px;
            font-weight: 700;
            color: #222;
        }
        .dark .title {
            color: #f5f5f5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border: 1px solid #ccc;
        }
        th, td {
            padding: 14px 16px;
            text-align: justify;
            border: 1px solid #ccc;
        }
        th {
            background-color: #fff6f7;
            font-weight: 600;
            color: #c66f28;
            font-size: 14px;
            text-align: center;
        }
        td {
            font-size: 14px;
        }
        tr:hover {
            background-color: #fff0f2;
        }
        .dark th {
            background-color: #3c2a2a;
            color: #c66f28;
        }
        .dark td {
            border-color: #555;
        }
        .dark tr:hover {
            background-color: #2a2a2a;
        }
        .tips-box {
            background: #fff6f8;
            border-left: 5px solid #c66f28;
            padding: 20px;
            border-radius: 12px;
            margin-top: 40px;
        }
        .dark .tips-box {
            background: #2c2c2c;
            border-left-color: #c66f28;
        }
        .tips-box h3 {
            color: #e2380d;
            margin-bottom: 10px;sss
            font-size: 18px;
        }
        .dark .tips-box h3 {
            color: #e2380d;
        }
        .tips-box ul {
            padding-left: 20px;
            color: #c66f28;
            font-size: 14px;
        }
        .dark .tips-box ul {
            color: #c66f28;
        }
        .tips-box li {
            margin-bottom: 8px;
        }
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            .title {
                margin-top: 10px;
            }
            table {
                font-size: 13px;
                text-align: center;
            }
            th, td {
                padding: 10px;
                text-align: center;
            }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <div class="container">
        <!-- Header -->
        <div class="header">
          
            <div class="title">Project Indicator</div>
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>DRAFT</td>
                    <td>
                        Project is saved.<br>
                        Valid to edit before submission date.
                    </td>
                    <td>
                        You can edit your project to submit the video link and make payment.<br>
                        
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SUBMITTED</td>
                    <td>
                        Project has been submitted, but has not yet been evaluated or participated in the competition.
                    </td>
                    <td>
                        You must complete payment and submission of video link.
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>COMPLETED</td>
                    <td>Project has been evaluated.</td>
                    <td>Please check File Repository to download Award & Participation Certificates.</td>
                </tr>
                <tr>
                    <th colspan="4">
                        <b style="color:yellow;">*</b> Once paid successfully, you cannot delete your project. <br>
                        <b style="color:yellow;">*</b> Once paid successfully, Letter of Acceptance & Receipt is available to download.
                    </th>
                    
                </tr>
            </tbody>
        </table>
        <flux:spacer/>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Fee</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        {{ $category->description }}
                    </td>
                    <td>
                        {{ $category->currency }} {{ $category->fee }} 
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4">
                        <b style="color:yellow;">*</b> Additional RM50 will be charged if choose to have book of chapter. <br>
                        <b style="color:yellow;">*</b> Submission of technical paper is compulsory if choose to have book of chapter. <br>
                    </th>
                </tr>
            </tbody>
        </table>
        <flux:spacer/>
        <table>
            <thead>
                @foreach($events as $event)
                <tr>
                    <th colspan="4">
                        {{ $event->name }}
                    </th>
                </tr>
                @endforeach
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>
                        Last Registration: {{ $event->date_register_end }}
                    </td>
                    <td>
                        Date of Submission: {{ $event->date_submission }}
                    </td>
                    <td>
                        Final Ceremony: {{ $event->date_ceremony }}
                    </td>
                </tr>
                
                @endforeach
                <tr>
                    <th colspan="4">
                        {{ $event->description }}
                    </th>
                </tr>
            </tbody>
        </table>

        <!-- Tips -->
        <div class="tips-box">
            <h3>Tips</h3>
            <ul>
                <li>You must pay first to get your Project Id.</li>
                <li>Receipt of your payment will also be emailed to your email account.</li>
                <li>If you have any inquiries or problems regarding your projects or events, please email us <a href="mailto:idrive@uthm.edu.my" style="font-style:italic; color:yellow;">here.</a></li>
            </ul>
        </div>
    </div>
</x-layouts.app>
