Event.observe(window, "load", function() {
    new JzTabPanel('TabPanelForm');
});

function popupDetallePlan(nPlan)
{
    Popup.open({
        url : 'index.php?request=popup-planes-terapeuticos/detalle-plan&plan=' + nPlan,
        width: 650, height: 420,
        resizable: "no"
    });
}