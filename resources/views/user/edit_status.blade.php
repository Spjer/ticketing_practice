<form action="{{ route('store_status') }}" method="POST" >
                          <select name="status_id" id="statu_id">
                            <option value="1">Open</option>
                            <option value="2">In progress</option>
                            <option value="3">Closed</option>
                          </select>
                        <button type="submit" class="btn btn-primary mt-3">Promijeni status</button>