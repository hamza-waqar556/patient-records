<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background-color: white;
            padding: 0;
            margin: 0;
        }

        * {
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        .page {
            margin-bottom: 30px;
            padding: 20px;
            width: 100%;
        }

        .pdf-main-container {
            width: 100%;
            padding: 20px;
            margin: 0 auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .heading h1 {
            font-size: 20px;
            margin: 0 0 10px 0;
        }

        .heading p {
            font-size: 14px;
            margin: 0;
        }

        .sub-heading {
            text-align: center;
            margin: 10px 0;

        }

        .row {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
            gap: 10px;
        }

        .justify-center {
            justify-content: center;
        }

        .align-items-end {
            align-items: end !important;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .w-33 {
            width: 33%;
        }

        .w-70 {
            width: 70%;
        }

        .w-75 {
            width: 75%;
        }

        .w-30 {
            width: 30%;
        }

        .w-40 {
            width: 40%;
        }

        .w-20 {
            width: 20%;
        }

        .w-25 {
            width: 25%;
        }

        .w-60 {
            width: 60%;
        }

        .w-80 {
            width: 80%;
        }

        .w-5 {
            width: 5%;
        }

        .text-capitalize {
            text-transform: capitalize;
        }

        .flex {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .g-0 {
            gap: 0 !important;
        }

        .fields {
            padding: 6px;
            border-bottom: 1px solid black;
            overflow: hidden;
            font-size: 12px;
        }

        .border-full {
            border: 1px solid #000;
        }

        .p-10 {
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            table-layout: fixed;
        }

        th {
            font-weight: 600;
            background-color: #f2f2f2;
        }

        th,
        td {
            font-size: 12px;
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: top;
        }

        tfoot td {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .w-10 {
            width: 10%;
        }

        .align-items-start {
            align-items: flex-start;
        }

        .fs-12 {
            font-size: 12px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .page {
                margin: 0;
                padding: 15mm;
            }

            .download-btn {
                display: none;
            }

            .pdf-main-container {
                width: 210mm;
            }

            .page {
                width: 210mm;
                /* A4 width */
                min-height: 297mm;
                /* A4 height */
            }


        }

        .fs-small {
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="pdf-main-container">
        <div class="page">
            <div class="heading">
                <h1>Detroit Wayne Integrated Health Network Daily Progress Note</h1>
                <p>Specialized Licensed Settings for CPT Codes H2016 & T1020</p>
            </div>
            <div class="row">
                <div class="flex text-capitalize w-40">
                    <strong class="fs-small">
                        Member:
                    </strong>
                    <span class="fields w-full">

                    </span>
                </div>
                <div class="flex text-capitalize w-40">
                    <strong class="w-25 fs-small">
                        MHWIN ID#:
                    </strong>
                    <span class="fields w-75">

                    </span>
                </div>
                <div class="flex text-capitalize w-20">
                    <strong class="fs-small">
                        Date:
                    </strong>
                    <span class="fields w-full">

                    </span>
                </div>
            </div>
            <div class="row">
                <div class="flex text-capitalize w-60">
                    <strong class="w-20 fs-small">
                        CRSP SC / CM:
                    </strong>
                    <span class="fields w-80">

                    </span>
                </div>
                <div class="flex text-capitalize w-40">
                    <strong class=" fs-small">
                        Facility:
                    </strong>
                    <span class="fields w-full">

                    </span>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="text-capitalize w-60">
                    <strong class=" fs-small">
                        Identified IPOS Goals:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
                <div class="flex text-capitalize w-20">
                    <strong class="w-40 fs-small">
                        CLS Hours:
                    </strong>
                    <span class="fields w-60">
                    </span>
                </div>
                <div class="flex text-capitalize w-20">
                    <strong class="w-40 fs-small">
                        PC Hours:
                    </strong>
                    <span class="fields w-60">
                    </span>
                </div>
            </div>

            <!-- Community services table -->
            <table>
                <thead>
                    <tr>
                        <th class="w-5">
                            AM
                        </th>
                        <th class="w-5">
                            Min
                        </th>
                        <th class="w-5">
                            PM
                        </th>
                        <th class="w-5">
                            Min
                        </th>
                        <th class="w-5">
                            MN
                        </th>
                        <th class="w-5">
                            Min
                        </th>
                        <th class="w-30 text-left">
                            Community Living Supports Objectives
                        </th>
                        <th class="w-40 text-left">
                            CLS Objective
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- c1 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C1 Meal Preparation/Kitchen Skills
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c2 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C2 Laundry
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c3 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C3 Housekeeping Skills
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c4 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C4 Behavioral Interventions Needed
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c5 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C5 Total Shopping
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c6 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C6 Money Management
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c7 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C7 Community/Socialization Skills
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c8 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C8 Attending Medical Appointments
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c9 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C9 Medication Instruction Skills
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c10 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C10 Health & Safety/Medical Complexity
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- c11 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            C11 Symptoms/Stress Management Skills
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">
                            Total CLS Mins:
                        </td>
                        <td colspan="3" class="text-center">

                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>

            <!-- Personal Care Objectives -->
            <table>
                <thead>
                    <tr>
                        <th class="w-5">
                            AM
                        </th>
                        <th class="w-5">
                            Min
                        </th>
                        <th class="w-5">
                            PM
                        </th>
                        <th class="w-5">
                            Min
                        </th>
                        <th class="w-5">
                            MN
                        </th>
                        <th class="w-5">
                            Min
                        </th>
                        <th class="w-30 text-left">
                            Personal Care Objectives
                        </th>
                        <th class="w-40 text-left">
                            PC Objective
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- p1 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            P1 Eating/Feeding
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- p2 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            P2 Toileting
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- p3 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            P3 Showering/Bathing/Personal Hygiene
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- p4 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            P4 Dressing
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- p5 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            P5 Mobility/Transferring
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- p6 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            P6 Medication Knowledge/Administration
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                    <!-- p7 row -->
                    <tr>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-5">

                        </td>
                        <td class="w-30 text-left">
                            P7 Complex Care
                        </td>
                        <td class="w-40 text-left">

                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">
                            Total CLS Mins:
                        </td>
                        <td colspan="3" class="text-center">

                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>

            <!-- signature -->
            <div class="row border-full p-10">
                <div class="flex text-capitalize w-70">
                    <strong class="w-30 fs-small">
                        Provider Supervisory Signature:
                    </strong>
                    <span class="fields w-70">

                    </span>
                </div>
                <div class="flex text-capitalize w-30">
                    <strong class="fs-small">
                        Date:
                    </strong>
                    <span class="fields w-full">

                    </span>
                </div>
            </div>
        </div>

        <div class="page">
            <div class="row">
                <div class="flex text-capitalize w-40">
                    <strong class="fs-small">
                        Member:
                    </strong>
                    <span class="fields w-full">

                    </span>
                </div>
                <div class="flex text-capitalize w-40">
                    <strong class="w-25 fs-small">
                        MHWIN ID#:
                    </strong>
                    <span class="fields w-75">

                    </span>
                </div>
                <div class="flex text-capitalize w-20">
                    <strong class="">
                        Date:
                    </strong>
                    <span class="fields w-full">

                    </span>
                </div>
            </div>
            <div class="heading">
                <h1>Detroit Wayne Integrated Health Network Daily Progress Note</h1>
                <p>Specialized Licensed Settings for CPT Codes H2016 & T1020</p>
            </div>

            <!-- TASK ID CODES -->
            <div class="sub-heading">
                <strong>
                    TASK ID CODES
                </strong>
            </div>
            <div class="flex border-collapse justify-center w-full text-center g-0 fs-12">
                <div class="border-full p-10 w-25">
                    <strong>H</strong> = Hospitalization
                </div>
                <div class="border-full p-10 w-25">
                    <strong>M</strong> = Monitoring
                </div>
                <div class="border-full p-10 w-25">
                    <strong>R</strong> = Refusal
                </div>
                <div class="border-full p-10 w-25">
                    <strong>ED</strong> = Education/Day Program
                </div>
            </div>
            <div class="flex border-collapse justify-center w-full text-center g-0 fs-12">
                <div class="border-full p-10 w-25">
                    <strong>TC</strong> = Total Care
                </div>
                <div class="border-full p-10 w-25">
                    <strong>PA</strong> = Physical Assist
                </div>
                <div class="border-full p-10 w-25">
                    <strong>VP</strong> = Verbal Prompts
                </div>
                <div class="border-full p-10 w-25">
                    <strong>LOA</strong> = Leave of Absence
                </div>
            </div>
            <div class="flex border-collapse justify-center w-full text-center g-0 fs-12">
                <div class="border-full p-10 w-25">
                    <strong>HOH</strong> = Hand Over Hand
                </div>
                <div class="border-full p-10 w-25">
                    <strong>I</strong> = Independent
                </div>
            </div>

            <!-- PROGRESS CODES -->
            <div class="sub-heading">
                <strong>
                    PROGRESS CODES
                </strong>
            </div>
            <div class="flex border-collapse justify-center w-full text-center g-0 fs-12 mb-20">
                <div class="border-full p-10 w-25">
                    <strong>IP</strong> = Increased Progress
                </div>
                <div class="border-full p-10 w-25">
                    <strong>DP</strong> = Decreased Progress
                </div>
                <div class="border-full p-10 w-25">
                    <strong>SP</strong> = Same Progress
                </div>
            </div>

            <!-- staff  -->
            <div class="row align-items-start">
                <div class=" text-capitalize w-20">
                    <strong class="w-full fs-small">
                        Staff Action/Outcome:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
                <div class=" text-capitalize w-10">
                    <strong class=" fs-small">
                        CLS/PC:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
                <div class=" text-capitalize w-10">
                    <strong class=" fs-small">
                        Task ID:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
                <div class="fields text-capitalize w-60">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore harum soluta laborum adipisci
                    eligendi possimus maxime quas dolor laboriosam nostrum deleniti corporis unde natus consequatur quis
                    magni quae, dolores magnam.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore harum soluta laborum adipisci
                    eligendi possimus maxime quas dolor laboriosam nostrum deleniti corporis unde natus consequatur quis
                    magni quae, dolores magnam.
                </div>
            </div>
            <div class="row ">
                <div class=" text-capitalize w-20">
                    <strong class="w-full fs-small">
                        Staff Signature:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
                <div class=" text-capitalize w-20">
                    <strong class=" fs-small">
                        Credentials:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
                <div class=" text-capitalize w-20">
                    <strong class=" fs-small">
                        PRINT NAME:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
                <div class=" text-capitalize w-20">
                    <strong class=" fs-small">
                        Staff Type:
                    </strong>
                    <div class="fields w-full">

                    </div>
                </div>
                <div class=" text-capitalize w-20">
                    <strong class=" fs-small">
                        Progress Code:
                    </strong>
                    <div class="fields w-full">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>