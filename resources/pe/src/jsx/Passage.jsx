var Passage = React.createClass({
    var prevChapNo = this.props.chaptetNo > 0 ? this.props.chapterNo - 1 : 1;
    var nextChapNo = this.props.chapterNo < 31 ? this.props.chapterNo + 1 : 31;

    render: function() {
        return (
            <table>
                <tr>
                    <td className="col-xs-1 text-center">
                        <a className="chevron-link" href=""></a>
                    </td>
                </tr>
            </table>
        );
    }
})
