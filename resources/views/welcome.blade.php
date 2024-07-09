<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>QR Code Generator</title>
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
</head>

<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('photo.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" required class="form-control"> <br>
                            <input type="submit" value="Submit" class="btn btn-info">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                @if (session('sms'))
                    <div class="alert alert-success">
                        <h4 class="text-center">{{ Session::get('sms') }}</h4>
                    </div>
                @endif
                <table class="table-bordered table">
                    <thead>
                        <tr class="text-center">
                            <td>Sl</td>
                            <td>Image</td>
                            <td>Qr code</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $key => $row)
                            <tr class="text-center">
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($row->image) }}" alt="" width="200" height="200">
                                </td>
                                <td>
                                    <div id="canvas{{ $row->id }}"></div>
                                </td>
                                <td>
                                    <a href="{{ route('delete', $row->id) }}"
                                        onclick="return confirm('Are you sure you want to delete this item???');"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    <br>
                                    <br>
                                    <button onclick="download({{ $row->id }})"
                                        class="btn btn-primary btn-sm">Download</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let canvasElements
            @foreach ($images as $key => $row)
                canvasElements = document.querySelectorAll("#canvas{{ $row->id }}");
                canvasElements.forEach(canvas => {
                    const qrCode = new QRCodeStyling({
                        width: 200,
                        height: 200,
                        type: "canvas",
                        data: "{{ asset($row->image) }}",
                        image: "{{ asset('images/logo.jpg') }}",
                        qrOptions: {
                            typeNumber: "0",
                            mode: "Byte",
                            errorCorrectionLevel: "Q"
                        },
                        dotsOptions: {
                            type: "extra-rounded",
                            color: "#6a1a4c",
                            gradient: {
                                type: "linear",
                                rotation: 0,
                                colorStops: [{
                                        offset: 0,
                                        color: "#c1151e"
                                    },
                                    {
                                        offset: 1,
                                        color: "#000000"
                                    }
                                ]
                            }
                        },
                        cornersSquareOptions: {
                            type: "extra-rounded",
                            color: "#6a1a4c",
                            gradient: {
                                type: "linear",
                                rotation: 0,
                                colorStops: [{
                                        offset: 0,
                                        color: "#c1151e"
                                    },
                                    {
                                        offset: 1,
                                        color: "#6a1a4c"
                                    }
                                ]
                            }
                        },
                        cornersDotOptions: {
                            "type": "",
                            "color": "#000000"
                        },
                        backgroundOptions: {
                            color: "#ffffff"
                        },
                        imageOptions: {
                            hideBackgroundDots: true,
                            imageSize: 0.4,
                            margin: 0
                        },
                        qrOptions: {
                            typeNumber: "0",
                            mode: "Byte",
                            errorCorrectionLevel: "Q"
                        },
                    });

                    // Append the QR code to the canvas element
                    qrCode.append(canvas);
                    // Render the QR code
                });
            @endforeach

        })
        const download = (id) => {
            console.log(id);
            let downloadLink = document.createElement('a');
            downloadLink.setAttribute('download', 'CanvasAsImage.png');
            let canvas = document.getElementById('canvas' + id).firstChild;
            canvas.toBlob(function(blob) {
                let url = URL.createObjectURL(blob);
                downloadLink.setAttribute('href', url);
                downloadLink.click();
            });
        }
    </script>
</body>

</html>
